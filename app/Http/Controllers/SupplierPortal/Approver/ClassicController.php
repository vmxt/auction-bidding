<?php

namespace App\Http\Controllers\SupplierPortal\Approver;

use App\Http\Controllers\Controller;
use App\EmailRecipient;
use Facades\App\Helpers\ListingHelper;
use App\Helpers\Webfocus\Setting;
use App\Http\Requests\ContactUsRequest;
use App\Mail\InquiryAdminMail;
use App\Mail\InquiryMail;
use App\Page;
use App\SupplierModels\SupplierDetails;
use App\Helpers\FileHelper;
use App\SupplierModels\Supplier;
use App\SupplierModels\SupplierApplicantProducts;
use App\SupplierModels\ApproverSteps;
use App\SupplierModels\Approvals;
use App\SupplierModels\ApproverTemplates;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Message;
use App\User;
use Carbon\Carbon;
use App\Mail\MessageSentToApproverNotification;
use App\Mail\MessageSentToSupplierNotification;
use App\Mail\FinalApprovalNotification;
use App\SupplierModels\SupplierApplicants;
use App\SupplierModels\ApproversSetting;
use App\SupplierModels\ApprovalHistory;
use App\SupplierModels\SupplierContactDetails;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\SupplierApplicantApproved;


class ClassicController extends Controller
{
	private $searchFields = ['id'];

	public function index() {

		$page = new Page();
		$page->name = 'Classic Data';

		$supplier_collection = SupplierDetails::where('from_classic',1);
        
        $suppliers = ListingHelper::simple_search_using_collection($supplier_collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);
        
        $searchType = 'simple_search';

		return view('theme.pmc_sms.supplier-portal.pages.approver.classic.index', compact('page', 'suppliers', 'filter'));

	}
	
	public function show() {
        //dd('test');

		$supplier_collection = SupplierDetails::where('from_classic',1)->get();
		
        $d = [];

        foreach( $supplier_collection as $supplier) {
            
            if( $supplier->supplier->id > 10437) {
                $pass = strtotime(date('Y-m-d h:i:s'));
            	$supplier->supplier->password = \Hash::make($pass);
            	$supplier->supplier->save();
                
            	$send_instruction_email_to_supplier = $this->approval_email($supplier->supplier,$pass);
            
                array_push($d, $supplier->supplier->id);            
            }
        }
		
		dd($d);
		
        $suppliers = ListingHelper::simple_search_using_collection($supplier_collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);
        
        $searchType = 'simple_search';

		return view('theme.pmc_sms.supplier-portal.pages.approver.classic.index', compact('page', 'suppliers', 'filter'));

	}

	public function upload(Request $request) {
		ini_set('max_execution_time', '0');
		$suppliers = Excel::toArray(new \App\Imports\SupplierImport, request()->file('classic'));

		$exist_emails = [];

		foreach( $suppliers as $supplier ) {
			foreach( $supplier as $s ) {
                
                $supp_exist = SupplierApplicants::where('email', $s[11])->first();
                
				if($supp_exist) {
					array_push($exist_emails, $supp_exist->email);
					
					$supp_exist->territory = 'Local';
                    $supp_exist->save();
                
                    // $supp_d_exist = SupplierDetails::where('company_name', $s[0])->first();
                    // $supp_d_exist->company_name = $s[1];
                    // $supp_d_exist->code = $s[0];
                    // $supp_d_exist->save();
                    
//                    $supp_contact_exist = SupplierDetails::where('email', $s[11])->first();
					
					continue;
				}
				
				// $applicant = new SupplierApplicants;
				// $applicant->name = $s[1];
				// $applicant->address = $s[3] . ',' . $s[6];
				// $applicant->commodities = null;
				// $applicant->contact_person = $s[10];
				// $applicant->territory = 'Global';
				// $applicant->designation = null;
				// $applicant->email = $s[11];
				// $applicant->status = 'Approved';
				// $applicant->save();

				// //create the user && send notification
				// $create_user = $this->create_user_after_approval($applicant);
    //         	//$send_instruction_email_to_supplier = $this->approval_email($applicant,$create_user[0]);

				// $applicant_details = new SupplierDetails;
				// $applicant_details->supplier_id = $create_user[1]->id;
				// $applicant_details->tin = $s[2];
				// $applicant_details->company_name = $s[1];
				// $applicant_details->unit = $s[3];
				// $applicant_details->country = ucfirst(strtolower(($s[6])));
				// $applicant_details->city  = $s[5];
				// $applicant_details->zip   = $s[8];
				// $applicant_details->code  = $s[0];
				// $applicant_details->from_classic = 1;
				// $applicant_details->status = 'Applicant';
				// $applicant_details->save();

				// $applicant_contact = new SupplierContactDetails;
				// $applicant_contact->supplier_id = $create_user[1]->id;
				// $applicant_contact->name = $s[10];
				// $applicant_contact->position = 'sales';
				// $applicant_contact->email = $s[11];
				// $applicant_contact->telephone_no = $s[9];
				// $applicant_contact->fax_no = $s[12];
				// $applicant_contact->pos = 'sales';
				// $applicant_contact->save();

			}
		}
        dd($exist_emails);
		return back();

	}


	public function create_user_after_approval($s){
        $name = explode(" ", $s->contact_person);
        $pass = strtotime(date('Y-m-d h:i:s'));
        $create_user = User::firstOrCreate([
            'first_name' => $name[0],
            'last_name' => str_replace($name[0]." ", "", $s->contact_person),
            'email' => $s->email,
            'username' => $s->email,
            'email_verified_at' => \Carbon\Carbon::now(),
            'password' => \Hash::make($pass),
            'active' => '1',
            'type' => 'supplier',
            'role_id' => '2',
            'user_id' => Auth::id()
        ]);

        return [$pass, $create_user];
    }


    public function approval_email($s,$u){
        Mail::to($s->email)
            ->send(new SupplierApplicantApproved($s,$u,true));
        return;
    }


}