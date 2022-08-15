<?php

namespace App\Http\Controllers\SupplierPortal\Supplier;

use Facades\App\Helpers\ListingHelper;
use App\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\SupplierModels\SupplierCategoryMaster;
use App\SupplierModels\SupplierCategoriesCustomFields;
use App\SupplierModels\SupplierApplicants;
use App\SupplierModels\SupplierDetails;
use App\SupplierModels\SupplierOfficers;
use App\SupplierModels\SupplierContactDetails;
use App\SupplierModels\SupplierBankDetails;
use App\SupplierModels\SupplierServices;
use App\SupplierModels\SupplierRequirements;
use App\SupplierModels\SupplierCredits;
use App\SupplierModels\SupplierCertifications;
use App\SupplierModels\SupplierCustomers;
use App\SupplierModels\SupplierFinancialStatus;
use App\SupplierModels\ApproverTemplates;
use App\SupplierModels\ApproverSteps;
use App\SupplierModels\Approvals;
use App\SupplierModels\ApprovalHistory;
use App\Permission;
use App\Page;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Message;
use App\Mail\RejectedSupplierNotification;
use App\Mail\NextApproverNotification;
use App\Mail\SupplierOnHoldNotification;
use App\Mail\PreviousApproverNotification;
use App\Mail\ApprovedSupplierNotification;
use Mail;
use App\Helpers\Webfocus\Setting;

class ApproverController extends Controller
{
    
	function __construct() {
//		$this->middleware('supplier');
	}
    
    public function approve_supplier(Request $request){
     
        $approval = Approvals::where('supplier_id',$request->approve_supplier_id)->latest()->first();

        // check if approval is_current == user || can override approvals
        $curr_approver = ApproverSteps::where('approval_id', $approval->id)
            ->where('is_current', 1)
            ->first();

        $logged_user_sequence = ApproverSteps::where('approval_id', $approval->id)
            ->where('approver_id', Auth::id())
            ->first();

        if($curr_approver->approver_id == Auth::id() ||
                in_array($curr_approver->sequence, $logged_user_sequence->override)) {

                $curr_approver->is_current = 0;
                $curr_approver->save();

                $approve = ApproverSteps::where('approver_id',Auth::id())->where('approval_id',$approval->id)->update([
                    'status' => 'Approved',
                    'approved_date' => \Carbon\Carbon::now(),
                    'is_current' => 0
                ]);

                $approve = ApproverSteps::where('approver_id',Auth::id())->where('approval_id',$approval->id)->first();

                $add_history_log = $this->history($approve,$request->approve_reason,$approval);

                $proceed_to_next_approver = $this->proceed_to_next_approver($approve);

                return back()->with('success','Successfully Approved Supplier!');

        }

        return back()->with('error', 'You are not the current approver of this application');

    }

    public function disapprove_supplier(Request $request){

        $disapproval = Approvals::where('supplier_id',$request->approve_supplier_id)->first();

        // check if approval is_current == user || can override approvals
        $curr_approver = ApproverSteps::where('approval_id', $disapproval->id)
            ->where('is_current', 1)
            ->first();

        $logged_user_sequence = ApproverSteps::where('approval_id', $disapproval->id)
            ->where('approver_id', Auth::id())
            ->first();

        if($curr_approver->approver_id == Auth::id() ||
                in_array($curr_approver->sequence, $logged_user_sequence->override)) {

            $disapprove = ApproverSteps::where('approver_id',Auth::id())->where('approval_id',$disapproval->id)->update([
                'status' => $request->dis_status
            ]);

            $disapprove = ApproverSteps::where('approver_id',Auth::id())->where('approval_id',$disapproval->id)->first();

            $add_history_log = $this->history($disapprove,$request->reason,$disapproval);
            $supp_details = SupplierDetails::where('supplier_id',$request->approve_supplier_id)->first();
            if($request->dis_status == 'Reject') {
                
                $disapprove->update(['denied_date' => \Carbon\Carbon::now() ]);
                
                $supp_details->update(['status' => 'Rejected']);
                $supp_account = User::find($request->approve_supplier_id);
                $supp_account->update(['active' => 0]);
                
                $supp_application = SupplierApplicants::where('email', $supp_account->email)->first();    
                $supp_application->update(
                    ['disapproved_by' => Auth::user()->username , 'disapproved_time' => \Carbon\Carbon::now(), 'status' => 'Disapproved' ]
                );

                $curr_approver->update(['is_current' => 0]);
                //$this->rejectSupplier($disapproval->id);

                Mail::to($supp_account->email)->send(new RejectedSupplierNotification($supp_account));

                return back()->with('success','Successfully Disapproved ('.$request->dis_status.') Supplier!');
            }

            if($request->dis_status == 'Hold') {
                $supp_details->update(['is_editable' => 1]);
                $disapprove->update(['hold_date' => \Carbon\Carbon::now() ]);
                //send message why onhold
                $supp = User::find($supp_details->supplier_id);
                Mail::to($supp->email)->send(new SupplierOnHoldNotification($supp, Setting::info(), $request->reason));

            }

            if($request->dis_status == 'Return to previous Approver')
                $return = $this->return_to_previous_approver($disapprove, $supp_details);

            return back()->with('success','Successfully Disapproved ('.$request->dis_status.') Supplier!');

        }

        return back()->with('error', 'You are not the current approver of this application');

    }

    public function history($approval,$message,$data){
        $history = ApprovalHistory::create([
            'user_id' => Auth::id(),
            'action' => $approval->status,
            'remarks' => $message,
            'approval_step_id' => $approval->id,
            'approval_id' => $data->id
        ]);
        return;
    }

    public function check_if_last_approver($rc){

        $next_approver = ApproverSteps::where('approval_id',$rc->approval_id)->where('id','>',$rc->id)->count();
        if($next_approver >= 1 )
            return false;
        else
            return true;
    }
    
    public function return_to_previous_approver($rc,$supp){

        $sequence = $rc->id;

        $return_to_pending = $rc->update(
            ['status' => 'Pending', 'is_current' => 0, 'date_started' => null]
        );

        $return_to_previous = ApproverSteps::where('approval_id',$rc->approval_id)->where('id','<',$sequence)->orderBy('id','desc')->first();

        $return_to_previous->update(
            ['status' => 'Pending', 'is_current' => 1, 'date_started' => \Carbon\Carbon::now()]
        );

        // add email notification 
        $approver = User::find($return_to_previous->approver_id);
        $curr_approver = User::find($rc->approver_id);

        $approver_seq = ApproverTemplates::where('approver_id', $approver->id)->first();
        $_cc = ApproverTemplates::where('sequence_no', 3)->first();

        if($approver->approver_settings->notif_for_new_suppliers){
            if( $approver_seq->sequence_no == 1 || $approver_seq->sequence_no == 2) {
                Mail::to($approver->email)
                    ->cc($_cc->user->email)
                    ->send(new PreviousApproverNotification($approver, Setting::info(), $curr_approver,$supp));
            } else {
                Mail::to($approver->email)->send(new PreviousApproverNotification($approver, Setting::info(), $curr_approver,$supp));
            }
        }
        
    }

    public function proceed_to_next_approver($rc){

        $is_last = $this->check_if_last_approver($rc);

        if($is_last === false){
         
            $sequence = $rc->id;

            $next_approver = ApproverSteps::where('approval_id',$rc->approval_id)->where('id','>',$sequence)->orderBy('id','asc')->first();
            $transfer = $next_approver->update(['is_current' => 1, 'date_started'   => \Carbon\Carbon::now() ]);

            // create notification
            $approver = User::find($next_approver->approver_id);
            $approver_seq = ApproverTemplates::where('approver_id', $approver->id)->first();
            $_cc = ApproverTemplates::where('sequence_no', 3)->first();

            if($approver->approver_settings->notif_for_new_suppliers){
                if( $approver_seq->sequence_no == 1 || $approver_seq->sequence_no == 2) {
                    Mail::to($approver->email)->cc($_cc->user->email)->send(new NextApproverNotification($approver, Setting::info()));
                } else {
                    Mail::to($approver->email)->send(new NextApproverNotification($approver, Setting::info()));
                }
            }

            return;
         
        } else {

            $tag_as_completed = $this->approval_completed($rc);
            
            // new
            // send email to approver 4
            $supp1 = Approvals::whereId($rc->approval_id)->first();
            $is_not_classic = SupplierDetails::where('supplier_id',$supp1->supplier_id)->first();

            if( $is_not_classic->from_classic != 1 || is_null($is_not_classic->code)) { 
                $seq4 = ApproverTemplates::where('sequence_no', 4)->first(); 
                $approver6 = User::find($seq4->approver_id);

                Mail::to($approver6->email)->send(new ApprovedSupplierNotification($approver6, Setting::info()));
            }
            
            return;
    
            // send email to approver 4 || OLD
            // $seq4 = ApproverTemplates::where('sequence_no', 4)->first(); 
            // $approver6 = User::find($seq4->approver_id);

            // Mail::to($approver6->email)->send(new ApprovedSupplierNotification($approver6, Setting::info()));

            // return;
        }
        
    }

    public function approval_completed($rc){
        
        // NEW
        $supplier = Approvals::whereId($rc->approval_id)->first();

        $supplier->update(['status' => 'Approved']);


        $tag_supplier_as_accredited = SupplierDetails::where('supplier_id',$supplier->supplier_id)->first();

        if( $tag_supplier_as_accredited->from_classic == 1 ) {
            $tag_supplier_as_accredited->update(['status' => 'Active']);
        } elseif( $tag_supplier_as_accredited->is_one_time == 1 && !is_null($tag_supplier_as_accredited->code) ) {
            $tag_supplier_as_accredited->update(['status' => 'Active', 'apply_as_permanent_done' => 1]);
        } else {
            $tag_supplier_as_accredited->update(['status' => 'Waiting For Vendor Code']);
        }

        return;
        
        // OLD
        // $supplier = Approvals::whereId($rc->approval_id)->first();

        // $supplier->update(['status' => 'Approved']);

        // $tag_supplier_as_accredited = SupplierDetails::where('supplier_id',$supplier->supplier_id)
        //     ->update(['status' => 'Waiting For Vendor Code']);

        // return;
    }


    public function rejectSupplier($approvalId) {

        $applicant = ApproverSteps::where('approval_id', $approvalId)->get();

        foreach( $applicant as $appli ) {
            $appli->update(['status'=> 'Reject']);
        }

    }   
   
}
