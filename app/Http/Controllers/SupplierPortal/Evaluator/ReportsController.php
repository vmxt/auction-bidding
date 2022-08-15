<?php

namespace App\Http\Controllers\SupplierPortal\Evaluator;

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
use Illuminate\Pagination\LengthAwarePaginator;

class ReportsController extends Controller
{

	function __construct() {
//		$this->middleware('supplier');
	}


	public function index() {

		$page = new Page;
		$page->name = 'Reports';


		$initial_regs = $this->getInitialRegistration();

		$sis_submission = $this->getSISSubmissions();

		$for_approvals = $this->getForApprovals();

		$active_suppliers = $this->getApprovedSuppliers();

		return view('theme.pmc_sms.supplier-portal.pages.evaluator.reports.index', compact('page', 'initial_regs', 'sis_submission', 'for_approvals', 'active_suppliers'));

	}

	public function getInitialRegistration() {

		$page = new Page;
		$page->name = 'Initial Registrations';

		$initial_regs = SupplierApplicants::where('status', 'pending')->paginate(20);		

		return view('theme.pmc_sms.supplier-portal.pages.evaluator.reports.pending-supplier', compact('page', 'initial_regs'));
	}

	public function getSISSubmissions() {

		$page = new Page;
		$page->name = 'SIS For Submission';

		$applicantss = [];

		$approved_applicants = SupplierApplicants::where('status', 'Approved')
			->get();

		foreach( $approved_applicants as $applicant ) {

			if( $applicant->has_account ) {

				if( $user = $applicant->user_obj ) {

					$applicant_details = SupplierDetails::where('supplier_id', $user->id)
						->first();

					if( $applicant_details ) { 
						
						if($applicant_details->status == 'Applicant') array_push($applicantss, $applicant);

					} else {
						array_push($applicantss, $applicant);
					}

				} else {

					array_push($applicantss, $applicant);

				}

			} 

		}

		$perPage = 20;

		$currentPage = LengthAwarePaginator::resolveCurrentPage();

		if ($currentPage == 1) {
		    $start = 0;
		}
		else {
		    $start = ($currentPage - 1) * $perPage;
		}

		$currentPageCollection = collect($applicantss)->slice($start, $perPage)->all();

		$sis_submission = new LengthAwarePaginator($currentPageCollection, count($applicantss), $perPage);

		$sis_submission->setPath(LengthAwarePaginator::resolveCurrentPath());

		return view('theme.pmc_sms.supplier-portal.pages.evaluator.reports.sis-for-submission', compact('page', 'sis_submission'));

		/*return SupplierDetails::where('status', 'Applicant')
			->get();*/
	}

	public function getForApprovals() {

		$page = new Page;
		$page->name = 'For Approval';

		$for_approvals  = SupplierDetails::where('status', 'On-going Approval')
			->paginate(20);

		foreach( $for_approvals  as $ongoing ) {

			$approval = Approvals::where('supplier_id', $ongoing->supplier_id)->first();
			$current_approver = ApproverSteps::where('approval_id', $approval->id)
				->where('is_current', 1)->first();

			$ongoing->current_approver = $current_approver;

		}

		return view('theme.pmc_sms.supplier-portal.pages.evaluator.reports.for-approval', compact('page', 'for_approvals'));

	}

	public function getApprovedSuppliers() {

		$page = new Page;
		$page->name = 'Active Suppliers';

		$active_suppliers =  SupplierDetails::where('status', 'Active')
			->paginate(20);

		return view('theme.pmc_sms.supplier-portal.pages.evaluator.reports.active-suppliers', compact('page', 'active_suppliers'));

	}
}