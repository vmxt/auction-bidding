<?php

namespace App\Http\Controllers\SupplierPortal\Evaluator;

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

class EvaluatorsController extends Controller
{

	private $searchFields = ['id'];

	public function login()
    {

        if(Auth::user()) return redirect()->route(Auth::user()->user_role_redirect());
        
        $page = new Page();
        $page->name = 'Login';
        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.evaluator.login',compact('page'));

    }


    public function dashboard () 
    {
    	
        $this->searchFields = ['company_name'];
        $page = new Page();
        $page->name = 'On-going Approval';

        $supplier_collection = SupplierDetails::where('status', 'On-going Approval')
            ->orWhere('status', 'Waiting For Vendor Code');
        
        $applicants = ListingHelper::simple_search_using_collection($supplier_collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);
        
        $searchType = 'simple_search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.evaluator.ongoing',compact('page', 'applicants', 'filter', 'searchType'));

    }
    

    public function ongoingSuppliers() {

        $this->searchFields = ['company_name'];
        $page = new Page();
        $page->name = 'On-going Approval';

        $supplier_collection = SupplierDetails::where('status', 'On-going Approval');
        
        $applicants = ListingHelper::simple_search_using_collection($supplier_collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);
        
        $searchType = 'simple_search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.approver.ongoing',compact('page', 'applicants', 'filter', 'searchType'));

    }

    public function rejectedSuppliers() {
        
        $this->searchFields = ['company_name'];
        $page = new Page();
        $page->name = 'Rejected Suppliers';

        $supplier_collection = SupplierDetails::where('status', 'Rejected');

        $applicants = ListingHelper::simple_search_using_collection($supplier_collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);
        
        $searchType = 'simple_search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.evaluator.rejected-suppliers',compact('page', 'applicants', 'filter', 'searchType'));
    }


    public function passwordReset() {
        $page = new Page();
        $page->name = 'Password Reset';
        return view('theme.pmc_sms.supplier-portal.pages.evaluator.account.reset', compact('page'));
    }

    public function passwordUpdate(Request $request) {
        $personalInfo = $request->validate([
            'current_password' => ['required', function ($attribute, $value, $fail) {
                if (!\Hash::check($value, auth()->user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password' => [
                'required',
                'min:8',
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'confirm_password' => 'required|same:password',
        ]);

        auth()->user()->update(['password' => bcrypt($personalInfo['password'])]);

        auth()->logout();

        return redirect()->route('evaluator.login')->with('success', 'Password has been updated');
    }
    

    public function applicationsPending () 
    {

        $this->searchFields = ['name'];

        $page = new Page();
        $page->name = 'Pending Applicants';

        $collection = SupplierApplicants::where('status', 'Pending');

        $applicants = ListingHelper::simple_search_using_collection($collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.approver.applicants-pending',compact('page', 'applicants', 'filter', 'searchType'));

    }

    public function applicationsApproved () 
    {

        $this->searchFields = ['name'];
        $page = new Page();
        $page->name = 'Approved Applicants';

        $collection = SupplierApplicants::where('status', 'Approved');

        $applicants = ListingHelper::simple_search_using_collection($collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.approver.applicants-approved',compact('page', 'applicants', 'filter', 'searchType'));

    }

    public function accreditedSuppliers() {
        
        $this->searchFields = ['company_name'];        
        $page = new Page();
        $page->name = 'Active Suppliers';

        $supplier_collection = SupplierDetails::where('status', 'Active');

        $applicants = ListingHelper::simple_search_using_collection($supplier_collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.evaluator.accredited-suppliers',compact('page', 'applicants', 'filter', 'searchType'));
    }

    public function applicationsRejected () 
    {

        $this->searchFields = ['name'];
        $page = new Page();
        $page->name = 'Reject Applicants';

        $collection = SupplierApplicants::where('status', 'Disapproved');

        $applicants = ListingHelper::simple_search_using_collection($collection, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.evaluator.applicants-rejected',compact('page', 'applicants', 'filter', 'searchType'));

    }
    
    public function notifyApprover() {

        // get all is_current and pending approval steps

        $pendingSteps = ApproverSteps::where('is_current', '1')
            ->where('status', 'Pending')
            ->get();

        foreach($pendingSteps as $pending) {
            // 2 days || 5 days || 10 days
            if($pending->date_started->diffInDays(Carbon::now()) == 2 ||
                $pending->date_started->diffInDays(Carbon::now()) == 5 || 
                $pending->date_started->diffInDays(Carbon::now()) == 10 ) {
                    dd('aw');
            }

        }

    }

    public function settings () 
    {
            
        $setting = ApproversSetting::where('approver_id', Auth::user()->id)
            ->first();

        $page = new Page();
        $page->name = 'Settings';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.approver.settings',compact('page','setting'));

    }

    public function postSettings (Request $request) 
    {
            
        $setting = ApproversSetting::where('approver_id', Auth::user()->id)->first();

        $input['approver_id'] = Auth::user()->id;
        $input['notif_for_new_suppliers'] = $request->input('notif_for_new_suppliers') ? 1:0;
        $input['notif_for_monthly_unapproved_request'] = $request->input('notif_for_monthly_unapproved_request') ? 1:0;
        $input['notif_to_forward_request_to_next_approver'] = $request->input('notif_to_forward_request_to_next_approver') ? 1:0;

        if($setting) {
            $setting->update($input);
        } else {
            ApproversSetting::create($input);
        }

        return back()->with('success', 'Settings successfully updated');

    }

    public function showHistory(Request $request) {

        $approval = Approvals::where('supplier_id', $request->supplier)
            ->first();

        $history = ApprovalHistory::where('approval_id', $approval->id)
            ->get();

        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.evaluator.reports.history',
            compact('history'));

    }


}