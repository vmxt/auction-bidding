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
use App\SupplierModels\SupplierPaymentTerms;
use App\SupplierModels\ApprovalHistory;
use App\Permission;
use App\Page;
use Storage;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Message;
use App\Helpers\Webfocus\Setting;
use App\SupplierModels\SupplierBusinessLines;
use App\Mail\NewSupplierApplication;
use Mail;
use App\Helpers\FileHelper;
use App\Mail\MessageSentToApproverNotification;
use App\Mail\MessageSentToSupplierNotification;
use App\SupplierModels\SupplierTempUpdate;
use Illuminate\Support\Facades\Hash;


class SupplierProfileController extends Controller
{
    
	function __construct() {
//		$this->middleware('supplier');        
	}
    
    public function profile($id)
    {

        if(\Auth::guest()) return back()->with('error', 'Please login to view the suppliers profile');
        
        $user = User::findOrFail($id);
        if($user->role_id <> 2) abort(404);
        $supplier_application = SupplierApplicants::where('email', $user->email)->first();
        $supplier_details = $user->supplier_details;
        $supplier_officers = $user->supplier_officers;
        $supplier_bank_d = $user->supplier_banks;
        $supplier_servicess = $user->supplier_services;
        $supplier_credits = $user->supplier_credits;
        $supplier_bli = $user->supplier_business_lines;
        $supplier_requirements = $user->supplier_requirements;
        $supplier_cqualities = $user->supplier_certifications()->where('name', 'quality standards')->get();    
        $supplier_csafety = $user->supplier_certifications()->where('name', 'safety standards')->get();
        $supplier_cenveronmentals = $user->supplier_certifications()->where('name', 'environmental standards')->get();
        $supplier_cothers = $user->supplier_certifications()->where('name', 'other standards')->get();
        $supplier_controlled_commodity = $user->supplier_certifications()->where('is_controlled_commodity', 1)->get();
        $supplier_mc = $user->supplier_customers()->where('is_customer_lty', 0)->get();
        $supplier_lty = $user->supplier_customers()->where('is_customer_lty', 1)->get();
        $supplier_contact_cs = $user->supplier_contacts()->where('pos', 'cs')->first();
        $supplier_contact_sales = $user->supplier_contacts()->where('pos', 'sales')->first();
        $supplier_contact_accounting = $user->supplier_contacts()->where('pos', 'accounting')->first();
        $supplier_financial_stats = $user->supplier_financial_status;
        $supplier_pt = $user->supplier_payment_terms;
        $messages = Message::where('to', $user->email)
            ->where('is_read', 0)
            ->get();
        $approval = Approvals::where('supplier_id',$user->id);
        $approval_history = [];
        if($approval)
            $approval_history = ApprovalHistory::whereIn('approval_id',$approval->pluck('id')->toArray())->orderBy('created_at','desc')->get();
         

        $page = new Page();
        $page->name = 'Profile';

        return view('theme.pmc_sms.supplier-portal.pages.supplier.profile',
            compact('user','page', 'supplier_details', 'supplier_officers', 'supplier_bank_d', 
            'supplier_servicess', 'supplier_credits', 'supplier_requirements', 'supplier_cqualities', 'supplier_csafety', 'supplier_cenveronmentals', 
            'supplier_cothers', 'supplier_controlled_commodity', 'supplier_mc', 'supplier_lty', 'supplier_contact_cs', 'supplier_contact_sales', 
            'supplier_contact_accounting', 'supplier_financial_stats','messages','approval_history','supplier_bli','supplier_application','supplier_pt'));
    }


    public function printProfile ($id) 
    {
        if(\Auth::guest()) return back()->with('error', 'Please login to view the suppliers profile');
        
        $user = User::findOrFail($id);
        if($user->role_id <> 2) abort(404);
        $supplier_application = SupplierApplicants::where('email', $user->email)->first();
        $supplier_details = $user->supplier_details;
        $supplier_officers = $user->supplier_officers;
        $supplier_bank_d_swift = $user->supplier_banks()->where('code_type', 'swift')->get();
        $supplier_bank_d_iban = $user->supplier_banks()->where('code_type', 'iban')->get();
        $supplier_servicess = $user->supplier_services;
        $supplier_credits = $user->supplier_credits;
        $supplier_bli = $user->supplier_business_lines;
        $supplier_requirements = $user->supplier_requirements;
        $supplier_cqualities = $user->supplier_certifications()->where('name', 'quality standards')->get();    
        $supplier_csafety = $user->supplier_certifications()->where('name', 'safety standards')->get();
        $supplier_cenveronmentals = $user->supplier_certifications()->where('name', 'environmental standards')->get();
        $supplier_cothers = $user->supplier_certifications()->where('name', 'other standards')->get();
        $supplier_controlled_commodity = $user->supplier_certifications()->where('is_controlled_commodity', 1)->get();
        $supplier_mc = $user->supplier_customers()->where('is_customer_lty', 0)->get();
        $supplier_lty = $user->supplier_customers()->where('is_customer_lty', 1)->get();
        $supplier_contact_cs = $user->supplier_contacts()->where('pos', 'cs')->first();
        $supplier_contact_sales = $user->supplier_contacts()->where('pos', 'sales')->first();
        $supplier_contact_accounting = $user->supplier_contacts()->where('pos', 'accounting')->first();
        $supplier_financial_stats = $user->supplier_financial_status;
        $supplier_pt = $user->supplier_payment_terms;
        $messages = Message::where('to', $user->email)
            ->where('is_read', 0)
            ->get();
        $approval = Approvals::where('supplier_id',$user->id)->first();
        $approval_history = [];
        if($approval)
            $approval_history = ApprovalHistory::where('approval_id',$approval->id)->orderBy('created_at','desc')->get();
         

        $page = new Page();
        $page->name = 'Profile';

        return view('theme.pmc_sms.supplier-portal.pages.supplier.printprofile',
            compact('user','page', 'supplier_details', 'supplier_officers', 'supplier_bank_d_swift','supplier_bank_d_iban', 
            'supplier_servicess', 'supplier_credits', 'supplier_requirements', 'supplier_cqualities', 'supplier_csafety', 'supplier_cenveronmentals', 
            'supplier_cothers', 'supplier_controlled_commodity', 'supplier_mc', 'supplier_lty', 'supplier_contact_cs', 'supplier_contact_sales', 
            'supplier_contact_accounting', 'supplier_financial_stats','messages','approval_history','supplier_bli','supplier_application','supplier_pt'));
    }
    

    public function edit()
    {

    	$user = User::where('email',Auth::user()->email)->first();       

        if($user->role_id != env('SUPPLIER_ID')) return back(); //->with('error', 'Please login to view the suppliers profile');

    	$applicant = SupplierApplicants::where('email',Auth::user()->email)->first();
        $supplier_details = $user->supplier_details;

        if($supplier_details && $supplier_details->status == 'On-going Approval' && $supplier_details->is_editable == 0)
            return \Redirect::route('sms.auth.profile.view',Auth::id())->with('error','Your profile is currently on approval stage. You cant update your profile for now.');
        
        if($supplier_details && $supplier_details->is_editable == 0 && $supplier_details->status == 'Active')
            return \Redirect::route('sms.auth.profile.view',Auth::id())->with('error','You cannot update your profile when your account is active.');            
        
        $supplier_officers = $user->supplier_officers;
        $supplier_banks = $user->supplier_banks;
        $supplier_servicess = $user->supplier_services;
        $supplier_bli = $user->supplier_business_lines;
        $supplier_credits = $user->supplier_credits;
        $supplier_requirements = $user->supplier_requirements;
        $supplier_cqualities = $user->supplier_certifications()->where('name', 'quality standards')->get();    
        $supplier_csafety = $user->supplier_certifications()->where('name', 'safety standards')->get();
        $supplier_cenveronmentals = $user->supplier_certifications()->where('name', 'environmental standards')->get();
        $supplier_cothers = $user->supplier_certifications()->where('name', 'other standards')->get();
        $supplier_controlled_commodity = $user->supplier_certifications()->where('is_controlled_commodity', 1)->get();
        $supplier_mc = $user->supplier_customers()->where('is_customer_lty', 0)->get();
        $supplier_lty = $user->supplier_customers()->where('is_customer_lty', 1)->get();
        $supplier_contact_cs = $user->supplier_contacts()->where('pos', 'cs')->first();
        $supplier_contact_sales = $user->supplier_contacts()->where('pos', 'sales')->first();
        $supplier_contact_accounting = $user->supplier_contacts()->where('pos', 'accounting')->first();
        $supplier_financial_stats = $user->supplier_financial_status;
        $supplier_pt = $user->supplier_payment_terms;
        $messages = Message::where('to', $user->email)
            ->where('is_read', 0)
            ->get();
        $banks = Setting::availableBanks();
        $page = new Page();
        $page->name = "Edit Profile";
        
        return view('theme.pmc_sms.supplier-portal.pages.supplier.update-profile',
            compact('user','page','applicant', 'supplier_details', 'supplier_officers', 'supplier_banks', 
            'supplier_servicess', 'supplier_credits', 'supplier_requirements', 'supplier_cqualities', 'supplier_csafety', 'supplier_cenveronmentals', 
            'supplier_cothers', 'supplier_controlled_commodity', 'supplier_mc', 'supplier_lty', 'supplier_contact_cs', 'supplier_contact_sales', 
            'supplier_contact_accounting', 'supplier_financial_stats','messages','supplier_bli','supplier_pt','banks'));
    }

    public function permanentProfile()
    {

    	$user = User::where('email',Auth::user()->email)->first();       

        if($user->role_id != env('SUPPLIER_ID')) return back(); //->with('error', 'Please login to view the suppliers profile');

    	$applicant = SupplierApplicants::where('email',Auth::user()->email)->first();
        $supplier_details = $user->supplier_details;

        if($supplier_details && $supplier_details->status == 'On-going Approval')
            return \Redirect::route('sms.auth.profile.view',Auth::id())->with('error','Your profile is currently on approval stage. You cant update your profile for now.');
        
        $supplier_officers = $user->supplier_officers;
        $supplier_banks = $user->supplier_banks;
        $supplier_servicess = $user->supplier_services;
        $supplier_bli = $user->supplier_business_lines;
        $supplier_credits = $user->supplier_credits;
        $supplier_requirements = $user->supplier_requirements;
        $supplier_cqualities = $user->supplier_certifications()->where('name', 'quality standards')->get();    
        $supplier_csafety = $user->supplier_certifications()->where('name', 'safety standards')->get();
        $supplier_cenveronmentals = $user->supplier_certifications()->where('name', 'environmental standards')->get();
        $supplier_cothers = $user->supplier_certifications()->where('name', 'other standards')->get();
        $supplier_controlled_commodity = $user->supplier_certifications()->where('is_controlled_commodity', 1)->get();
        $supplier_mc = $user->supplier_customers()->where('is_customer_lty', 0)->get();
        $supplier_lty = $user->supplier_customers()->where('is_customer_lty', 1)->get();
        $supplier_contact_cs = $user->supplier_contacts()->where('pos', 'cs')->first();
        $supplier_contact_sales = $user->supplier_contacts()->where('pos', 'sales')->first();
        $supplier_contact_accounting = $user->supplier_contacts()->where('pos', 'accounting')->first();
        $supplier_financial_stats = $user->supplier_financial_status;
        $supplier_pt = $user->supplier_payment_terms;
        $messages = Message::where('to', $user->email)
            ->where('is_read', 0)
            ->get();
        $banks = Setting::availableBanks();
        $page = new Page();
        $page->name = "Edit Profile";
        
        return view('theme.pmc_sms.supplier-portal.pages.supplier.permanent-supplier-form',
            compact('user','page','applicant', 'supplier_details', 'supplier_officers', 'supplier_banks', 
            'supplier_servicess', 'supplier_credits', 'supplier_requirements', 'supplier_cqualities', 'supplier_csafety', 'supplier_cenveronmentals', 
            'supplier_cothers', 'supplier_controlled_commodity', 'supplier_mc', 'supplier_lty', 'supplier_contact_cs', 'supplier_contact_sales', 
            'supplier_contact_accounting', 'supplier_financial_stats','messages','supplier_bli','supplier_pt','banks'));
    }


    public function update(Request $request) {

        if(auth()->user()->is_one_time == 0){
            $this->validate($request, [
                'tin'   => 'unique:supplier_details,tin,'.Auth::id().',supplier_id|required_if:market_territory,Local' ,
                'cs_email'  => 'email|nullable' ,
                'sales_email' => 'email|nullable' ,
                'accounting_email' => 'email|nullable'
            ]);
        }
        
        // replace with authenticated user 
        $user = User::find(Auth::id());
        $user->account_updated = 1;
        $user->save();

        $supplier_officers = json_decode($request->h_officers, true);
        $supplier_bank_d = json_decode($request->h_bank_details, true);
        // $supplier_bank_d_iban = json_decode($request->h_bank_details_iban, true);
        $supplier_access_credits = json_decode($request->h_ac, true);
        $supplier_cqualities = json_decode($request->h_cqualities, true);
        $supplier_cenveronmentals = json_decode($request->h_cenveronmentals, true);
        $supplier_csafety = json_decode($request->h_csafety, true);
        $supplier_cothers = json_decode($request->h_cothers, true);
        $supplier_mc = json_decode($request->h_mc, true);
        $supplier_clty = json_decode($request->h_clty, true);
        //$supplier_services = json_decode($request->h_services, true);
        $supplier_bli = json_decode($request->h_bli, true);
        $supplier_pt = json_decode($request->h_pt, true);
        $supplier_services = json_decode($request->h_cles, true);
        $supplier_certsss = json_decode($request->h_certss, true);
        $supplier_greq = json_decode($request->h_genreq, true);
        $supplier_controlled_commodity = json_decode($request->h_controlled_comms, true);
        $supplier_fs = json_decode($request->h_fs, true);

        // Create data for supplier details
        $b_type = $request->business_type;
        if( $request->business_type == 'other' ) {
            $b_type = $request->other_business_type;
        }

        // edit or create supplier details
        if( $user->supplier_details ) {
            $supp_details = $user->supplier_details;
        } else {
            $supp_details = new SupplierDetails();
        }

        $supp_details->supplier_id = $user->id;
        $supp_details->company_name = $request->name;
        $supp_details->tin = $request->tin;
        $supp_details->vat_registered = $request->vat_registered == 'yes' ? 1:0;
        $supp_details->date_established = \Carbon\Carbon::parse($request->date_established)->format('Y-m-d');
        $supp_details->website = $request->website;
        $supp_details->organization_type = $request->organization_type;
        $supp_details->business_type = $b_type;
        $supp_details->unit = $request->unit;
        $supp_details->block = $request->block;
        $supp_details->street = $request->street;
        $supp_details->barangay = $request->country == 'Philippines' ? $request->local_barangay : $request->barangay;
        $supp_details->city = $request->country == 'Philippines' ? $request->local_city : $request->city;
        $supp_details->business_style = $request->business_style;
        $supp_details->province = $request->country == 'Philippines' ? $request->local_province : $request->province;
        $supp_details->country = $request->country;
        $supp_details->zip = $request->zip;
        $supp_details->is_one_time = $user->is_one_time;
        $supp_details->apply_as_permanent = $request->has('h_is_one_time') ? 1:0;

        $attachments_f = [];
        if($request->hasFile('input2')){

            foreach($request->input2 as $photo){

                $name = $this->move_banner_to_official_folder($photo);

                $name = explode("/", $name);

                $name = array_reverse($name);

                array_push($attachments_f, $name[0]);

            }
        }

        $attachment_implode = null;

        // check attachment if not empty
        if(!is_null($supp_details->attachments)) {

            $attachment_explode     = explode(",", $supp_details->attachments);
            $attachment_merge       = array_merge($attachment_explode, $attachments_f);
            $attachment_implode     = implode(",", $attachment_merge);

        } else {
            if(count($attachments_f))
                $attachment_implode     = implode(",", $attachments_f);
        }

        $supp_details->attachments = $attachment_implode;
        $supp_details->save();


        if($user->supplier_business_lines) {
            foreach( $user->supplier_business_lines as $business_line) {
                $business_line->delete();
            }
        }

        if(count($supplier_bli)) {

            foreach( $supplier_bli as $bli ) {
                $supp_bli = new SupplierBusinessLines;
                $supp_bli->supplier_id = $user->id;
                $supp_bli->name = $bli == 'others' ? $request->others_license_name : $bli['name'];
                $supp_bli->type = $bli['type'];
                $supp_bli->save();
            }

        }

        //create data for supplier officers 
        $officer_instance = [];

        // remove first the existing officers before adding new
        $existing_officers = $user->supplier_officers;
        if($existing_officers){
            foreach($existing_officers as $officer){
                $officer->delete();
            }
        }

        $supplier_officers = array_filter($supplier_officers);
        foreach( $supplier_officers as $officer ) {

            if( $officer['name'] == "" || $officer['position'] == "") continue;

            if( !SupplierOfficers::where('name', $officer['name'])
                ->where('position', $officer['position'])
                ->where('supplier_id', $user->id)
                ->first()
            ) {

                $supp_officer = new SupplierOfficers;
                $supp_officer->supplier_id = $user->id;
                $supp_officer->name = $officer['name'];
                $supp_officer->position = $officer['position'];
                $supp_officer->save();

            }

        }

        // remove first the existing supplier contacts 
        $existing_supplier_contacts = $user->supplier_contacts;
        if($existing_supplier_contacts){
            foreach( $existing_supplier_contacts as $contact) {
                $contact->delete();
            }
        }        

        // create supplier contact details

        $cs_contact_d = new SupplierContactDetails;
        $cs_contact_d->supplier_id = $user->id;
        $cs_contact_d->name = $request->cs_name;
        $cs_contact_d->position = $request->cs_position;
        $cs_contact_d->email = $request->cs_email;
        $cs_contact_d->telephone_no = $request->cs_telephone;
        $cs_contact_d->fax_no = $request->cs_fax;
        $cs_contact_d->mobile_no = $request->cs_mobile;
        $cs_contact_d->skype = $request->cs_skype;
        $cs_contact_d->others = $request->cs_others;
        $cs_contact_d->pos = 'cs';
        $cs_contact_d->save();

        $sales_contact_d = new SupplierContactDetails;
        $sales_contact_d->supplier_id = $user->id;
        $sales_contact_d->name = $request->sales_name;
        $sales_contact_d->position = $request->sales_position;
        $sales_contact_d->email = $request->sales_email;
        $sales_contact_d->telephone_no = $request->sales_telephone;
        $sales_contact_d->fax_no = $request->sales_fax;
        $sales_contact_d->mobile_no = $request->sales_mobile;
        $sales_contact_d->skype = $request->sales_skype;
        $sales_contact_d->others = $request->sales_others;
        $sales_contact_d->pos = 'sales';
        $sales_contact_d->save();

        $accounting_contact_d = new SupplierContactDetails;
        $accounting_contact_d->supplier_id = $user->id;
        $accounting_contact_d->name = $request->accounting_name;
        $accounting_contact_d->position = $request->accounting_position;
        $accounting_contact_d->email = $request->accounting_email;
        $accounting_contact_d->telephone_no = $request->accounting_telephone;
        $accounting_contact_d->fax_no = $request->accounting_fax;
        $accounting_contact_d->mobile_no = $request->accounting_mobile;
        $accounting_contact_d->skype = $request->accounting_skype;
        $accounting_contact_d->others = $request->accounting_others;
        $accounting_contact_d->pos = 'accounting';
        $accounting_contact_d->save();

        // remove existing bank details
        $existing_bank_accnts = $user->supplier_banks;
        if(count($existing_bank_accnts)){
            foreach($existing_bank_accnts as $accnt) {
                $accnt->delete();
            }
        }

        $supplier_bank_d = array_filter($supplier_bank_d);
        if(count($supplier_bank_d)) {
            foreach( $supplier_bank_d as $bank_option ) {

                $bank = new SupplierBankDetails;
                $bank->supplier_id = $user->id;
                $bank->bank_name = $bank_option['name'];
                $bank->account_name = $bank_option['account'];
                $bank->save();

            }
        }


        // remov supplier services
        $existing_supplier_services = $user->supplier_services;
        if($existing_supplier_services) {
            foreach( $existing_supplier_services as $service) {
                $service->delete();
            }
        }

        // create data for supplier services
        if(count($supplier_services)) {

            foreach( $supplier_services as $service ) {

                // $service_prefix = str_replace(" ", "_", $service);
                // $service_name = ucwords($service);
                // $service_license = "{$service_prefix}_license";
                // $service_img = "{$service_prefix}_img";
                // $service_img_path = null;

                // if($request->hasFile($service_img)) {
                //     $fileName = $request->$service_img->getClientOriginalName();
                //     $path = \Storage::disk('public')->putFileAs("images/supplier/profile{$user->id}/{$service_prefix}", $request->$service_img, $fileName);
                //     $service_img_path = \Storage::disk('public')->url($path);
                // }
                $supp_services = new SupplierServices;
                $supp_services->supplier_id = $user->id;
                $supp_services->name = $service['name'];
                $supp_services->cat = $service['cat'];
                $supp_services->other_name = $service['other_name'] != "" ? $service['other_name'] : null;
                $supp_services->save();

            }

        }


        // remove existing supplier access form credits
        $existing_supplier_afc = $user->supplier_credits;
        if($existing_supplier_afc){
            foreach($existing_supplier_afc as $afc) {
                $afc->delete();
            }
        }

        //create data for access form credit
        $supplier_credits = [];
        foreach( $supplier_access_credits as $credit ) {

            if(!SupplierCredits::where('institution', $credit['institution'])
                ->where('address', $credit['address'])
                ->where('supplier_id', $user->id)
                ->where('phone', $credit['phone'])->first()
            ) {
                $supp_credit = new SupplierCredits;
                $supp_credit->supplier_id = $user->id;
                $supp_credit->institution = $credit['institution'];
                $supp_credit->address = $credit['address'];
                $supp_credit->phone = $credit['phone'];
                $supp_credit->save();
            }

        }

        // dd($request->all());
        // dd($supplier_greq);
        // remove supplier existing general requirements
        $existing_gen_req = $user->supplier_requirements;
        if($existing_gen_req){
            foreach($existing_gen_req as $req) {
                $req->delete();
            }
        }

        // create data for supplier general requirements
        $attachment_folder = env('APP_URL').'/storage/images/supplier/profile'.$user->id."/supplier-details/attachment/";

        $supplier_requirements = [];
        if(count($supplier_greq)) {
            foreach( $supplier_greq as $requirement ) {
                $banner = null;

                if($requirement['name'] != 'license to operate'){

                    if( $request->country == 'Philippines' && 
                        ( $requirement['name'] == 'sample charge invoice' || $requirement['name'] == 'company profile' 
                            || $requirement['name'] == 'general information sheet' ) ){
                        $req_attachment = "ph_".str_replace(" ", "_",$requirement['name'])."_attachment";
                    } else {

                        if( $request->country != 'Philippines' && 
                        ( $requirement['name'] == 'sample charge invoice' || $requirement['name'] == 'company profile' 
                            || $requirement['name'] == 'general information sheet' ) ) {
                            $req_attachment = "foreign_".str_replace(" ", "_",$requirement['name'])."_attachment";
                        } else {
                            $req_attachment = str_replace(" ", "_",$requirement['name'])."_attachment";
                        }
                    }

                    if($request->has("{$req_attachment}") && is_null($requirement['img_exist'])) {
                        $banner = $this->move_banner_to_official_folder($request->file("{$req_attachment}"));
                    } else {
                        $banner = $attachment_folder.$requirement['img_exist'];
                    }

                }

                if(!is_null($banner)) {
                    $banner = explode('/', $banner);
                    $banner = array_reverse($banner);
                }

                $supp_req = new SupplierRequirements;
                $supp_req->supplier_id = $user->id;
                $supp_req->name = $requirement['name'];
                $supp_req->attachment = $banner[0];
                $supp_req->validity = $requirement['validity'] != null ? \Carbon\Carbon::parse($requirement['validity']) : null;
                $supp_req->save();
            }

        }

        // remove supplier certification for quality
        // $existing_supplier_certs = $user->supplier_certifications()->where('details', '!=', 'for controlled commodity')->get();
        $existing_supplier_certs = $user->supplier_certifications()->whereNull('details')->get();

        if($existing_supplier_certs){
            foreach($existing_supplier_certs as $cert) {
                $cert->delete();
            }
        }

        // create data for supplier certification
        // $supplier_cert_qualities = [];
        $supplier_cqualities = array_filter($supplier_cqualities);
        foreach( $supplier_cqualities as $cert_quality ) {
            $cert_quality['validity'] = \Carbon\Carbon::parse($cert_quality['validity'])->format('Y-m-d');
            
            if(!SupplierCertifications::where('name', 'quality standards')
                ->where('certification_number', $cert_quality['cert_no'])
                ->where('certification_validity', $cert_quality['validity'])
                ->where('supplier_id', $user->id)
                ->where('certification_body', $cert_quality['body'])->first()
            ) {
                $cert_q = new SupplierCertifications;
                $cert_q->supplier_id = $user->id;
                $cert_q->name = 'quality standards';
                $cert_q->cat = 'quality standards';
                $cert_q->certification_number = $cert_quality['cert_no'];
                $cert_q->certification_validity = $cert_quality['validity'];
                $cert_q->certification_body = $cert_quality['body'];
                $cert_q->save();
            }

        }

        // $supplier_cert_env = [];
        $supplier_cenveronmentals = array_filter($supplier_cenveronmentals);
        foreach( $supplier_cenveronmentals as $cert_env ) {

            $cert_env['validity'] = \Carbon\Carbon::parse($cert_env['validity'])->format('Y-m-d');
            if(!SupplierCertifications::where('name', 'environmental standards')
                ->where('certification_number', $cert_env['cert_no'])
                ->where('certification_validity', $cert_env['validity'])
                ->where('supplier_id', $user->id)
                ->where('certification_body', $cert_env['body'])->first()
            ) {
                $cert_e = new SupplierCertifications;
                $cert_e->supplier_id = $user->id;
                $cert_e->name = 'environmental standards';            
                $cert_e->cat = 'environmental standards';
                $cert_e->certification_number = $cert_env['cert_no'];
                $cert_e->certification_validity = $cert_env['validity'];
                $cert_e->certification_body = $cert_env['body'];
                $cert_e->save();
            }

        }

        // $supplier_cert_safety = [];
        $supplier_csafety = array_filter($supplier_csafety);
        foreach( $supplier_csafety as $cert_safety ) {

            $cert_safety['validity'] = \Carbon\Carbon::parse($cert_safety['validity'])->format('Y-m-d');
            if(!SupplierCertifications::where('name', 'safety standards')
                ->where('certification_number', $cert_safety['cert_no'])
                ->where('certification_validity', $cert_safety['validity'])
                ->where('supplier_id', $user->id)
                ->where('certification_body', $cert_safety['body'])->first()
            ) {
                $cert_s = new SupplierCertifications;
                $cert_s->supplier_id = $user->id;
                $cert_s->name = 'safety standards';
                $cert_s->cat = 'safety standards';
                $cert_s->certification_number = $cert_safety['cert_no'];
                $cert_s->certification_validity = $cert_safety['validity'];
                $cert_s->certification_body = $cert_safety['body'];
                $cert_s->save();
            }

        }

        // $supplier_cert_others = [];
        $supplier_cothers = array_filter($supplier_cothers);
        foreach( $supplier_cothers as $cert_others ) {

            $cert_others['validity'] = \Carbon\Carbon::parse($cert_others['validity'])->format('Y-m-d');
            if(!SupplierCertifications::where('name', 'other standards')
                ->where('certification_number', $cert_others['cert_no'])
                ->where('certification_validity', $cert_others['validity'])
                ->where('supplier_id', $user->id)
                ->where('certification_body', $cert_others['body'])->first()
            ) {
                $cert_o = new SupplierCertifications;
                $cert_o->supplier_id = $user->id;
                $cert_o->name = 'other standards';
                $cert_o->cat = 'other standards';
                $cert_o->certification_number = $cert_others['cert_no'];
                $cert_o->certification_validity = $cert_others['validity'];
                $cert_o->certification_body = $cert_others['body'];
                $cert_o->save();
            }
        }

        // if(count($supplier_certsss)) {
        //     foreach($supplier_certsss as $certsss) {

        //         $cert = new SupplierCertifications;
        //         $cert->supplier_id = $user->id;
        //         $cert->name = $certsss['name'] . ' standards';
        //         $cert->cat = $certsss['name'] . ' standards';
        //         $cert->certification_number = $certsss['cert_no'];
        //         $cert->certification_validity = \Carbon\Carbon::parse($certsss['cert_validity']);
        //         $cert->certification_body = $certsss['cert_body'];
        //         $cert->save();

        //     }
        // }


        $supplier_additional_cert = [];
        $controlled_comms = $user->supplier_certifications()->where('details', 'for controlled commodity')
            ->where('is_controlled_commodity', 1)->get();

        if(count($controlled_comms)) {
            foreach($controlled_comms as $comms) {
                $comms->delete();
            } 
        }

        if(count($supplier_controlled_commodity)) {

            foreach($supplier_controlled_commodity as $controlled_comm) {

                $banner = null;

                $req_attachment = str_replace(" ", "_",$controlled_comm['name'])."_attachment";

                if($request->has("{$req_attachment}") && is_null($controlled_comm['img_exist'])) {
                    $banner = $this->move_banner_to_official_folder($request->file("{$req_attachment}"));
                } else {
                    $banner = $attachment_folder.$controlled_comm['img_exist'];
                }

                if(!is_null($banner)) {
                    $banner = explode('/', $banner);
                    $banner = array_reverse($banner);
                }

                $cert_other = new SupplierCertifications;
                $cert_other->supplier_id = $user->id;
                $cert_other->name = $controlled_comm['name'];
                $cert_other->details = 'for controlled commodity';
                $cert_other->is_controlled_commodity = 1;
                $cert_other->attachment = $banner[0];
                $cert_other->cat = 'other';
                $cert_other->save();

            }

        }

        // remove existing major customers
        $existing_supplier_customers = $user->supplier_customers;
        if($existing_supplier_customers) {
            foreach($existing_supplier_customers as $customer) {
                $customer->delete();
            }
        }

        // add supplier major customers
        $supplier_major_customers = [];
        $supplier_mc = array_filter($supplier_mc);
        foreach( $supplier_mc as $mc ) {

            if(!SupplierCustomers::where('is_customer_lty', 0)
                ->where('name', $mc['name'])
                ->where('phone', $mc['phone'])
                ->where('address', $mc['address'])
                ->where('email', $mc['email'])
                ->where('supplier_id', $user->id)
                ->first()
            ) {
                $supp_mc = new SupplierCustomers;
                $supp_mc->supplier_id = $user->id;
                $supp_mc->name = $mc['name'];
                $supp_mc->address = $mc['address'];
                $supp_mc->phone = $mc['phone'];
                $supp_mc->email = $mc['email'];
                $supp_mc->save();
            }

        }

        $supplier_customers_lty = [];
        $supplier_clty = array_filter($supplier_clty);
        foreach( $supplier_clty as $lty ) {

            if(!SupplierCustomers::where('is_customer_lty', 1)
                ->where('name', $lty['name'])
                ->where('phone', $lty['phone'])
                ->where('address', $lty['address'])
                ->where('email', $lty['email'])
                ->where('supplier_id', $user->id)
                ->first()
            ) {

                $supp_lty = new SupplierCustomers;
                $supp_lty->supplier_id = $user->id;
                $supp_lty->name = $lty['name'];
                $supp_lty->address = $lty['address'];
                $supp_lty->phone = $lty['phone'];
                $supp_lty->email = $lty['email'];
                $supp_lty->is_customer_lty = 1;
                $supp_lty->save();

            }

        }

        // remove supplier financial status
        $existing_supplier_fs = $user->supplier_financial_status;
        if($existing_supplier_fs){
            foreach($existing_supplier_fs as $fs) {
                $fs->delete();
            }
        }

        // add supplier financial status
        if(count($supplier_fs)) {
            foreach( $supplier_fs as $fs ) {

                $req_attachment = str_replace(" ", "_",$fs['name'])."_attachment";

                if($request->has("{$req_attachment}") && is_null($fs['img_exist'])) {
                    $banner = $this->move_banner_to_official_folder($request->file("{$req_attachment}"));
                } else {
                    $banner = $attachment_folder.$fs['img_exist'];
                }

                if(!is_null($banner)) {
                    $banner = explode('/', $banner);
                    $banner = array_reverse($banner);
                }
                $supp_fs = new SupplierFinancialStatus;
                $supp_fs->supplier_id = $user->id;
                $supp_fs->name = $fs['name'];
                $supp_fs->attachment = $banner[0];
                $supp_fs->date = \Carbon\Carbon::now();
                $supp_fs->save();

            }

        }

        // remove supplier payment terms
        $existing_supplier_pt = $user->supplier_payment_terms;
        if($existing_supplier_pt){
            foreach($existing_supplier_pt as $pt) {
                $pt->delete();
            }
        }

        if($request->has('pt')) {

            foreach( $request->pt as $p_term ) {

                $supp_pt = new SupplierPaymentTerms;
                $supp_pt->supplier_id = $user->id;
                $supp_pt->name = $p_term;
                $supp_pt->save();

            }

        }

        return redirect()->route('sms.auth.profile.view', $user->id)->with('success','successfully saved');

    }



    public function updateRequest() {

        $page = new Page;
        $page->name = 'Update Profile';

        return view('theme.pmc_sms.supplier-portal.pages.supplier.request-update-profile',
            compact('page'));

    }


    public function requestUpdateSection(Request $request) {

        if( $request->section == 'general_information' ) {
        
            $data = SupplierDetails::where('supplier_id', Auth::user()->id)->first();

            $countries = json_decode(file_get_contents(public_path('data/countriesWithCode.json')), true);

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.general_information', compact('data', 'countries'));

        }

        if( $request->section == 'business_lines' ) {

            $data = SupplierBusinessLines::where('supplier_id', Auth::user()->id)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.business_lines', compact('data'));

        }

        if( $request->section == 'officers' ) {

            $data = SupplierOfficers::where('supplier_id', Auth::user()->id)->get();
            
            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.officers', compact('data'));

        }

        if( $request->section == 'contact_details' ) {

            $supplier_contact_cs = SupplierContactDetails::where('supplier_id', Auth::user()->id)->where('pos', 'cs')->first();
            $supplier_contact_sales = SupplierContactDetails::where('supplier_id', Auth::user()->id)->where('pos', 'sales')->first();
            $supplier_contact_accounting = SupplierContactDetails::where('supplier_id', Auth::user()->id)->where('pos', 'accounting')->first();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.contact_details', compact('supplier_contact_cs', 'supplier_contact_sales', 'supplier_contact_accounting'));

        }

        if( $request->section == 'bank_details' ) {

            $data = SupplierBankDetails::where('supplier_id', Auth::user()->id)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.bank_details', compact('data'));

        }

        if( $request->section == 'goods_and_services' ) {

            $data = SupplierServices::where('supplier_id', Auth::user()->id)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.goods_and_services', compact('data'));

        }

        if( $request->section == 'access_credits' ) {

            $data = SupplierCredits::where('supplier_id', Auth::user()->id)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.access_credits', compact('data'));

        }

        if( $request->section == 'general_requirements' ) {

            $data = SupplierRequirements::where('supplier_id', Auth::user()->id)->get();
            $supplier_details = SupplierDetails::where('supplier_id', Auth::user()->id)->first();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.general_requirements', compact('data','supplier_details'));

        }

        if( $request->section == 'certifications' ) {

            $supplier_cqualities = SupplierCertifications::where('name', 'quality standards')
                ->where('supplier_id', Auth::useR()->id)->get();    
            $supplier_csafety = SupplierCertifications::where('name', 'safety standards')
                ->where('supplier_id', Auth::useR()->id)->get();
            $supplier_cenveronmentals = SupplierCertifications::where('name', 'environmental standards')
                ->where('supplier_id', Auth::useR()->id)->get();
            $supplier_cothers = SupplierCertifications::where('name', 'other standards')
                ->where('supplier_id', Auth::useR()->id)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.certifications', 
                compact('supplier_cqualities', 'supplier_csafety','supplier_cenveronmentals','supplier_cothers'));            

        }

        if( $request->section == 'controlled_commodities' ) {

            $data = SupplierCertifications::where('supplier_id', Auth::user()->id)
                    ->where('is_controlled_commodity', 1)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.controlled_commodities', compact('data'));

        }

        if( $request->section == 'customers' ) {

            $supplier_mc    = SupplierCustomers::where('supplier_id', Auth::user()->id)->where('is_customer_lty', 0)->get();
            $supplier_lty   = SupplierCustomers::where('supplier_id', Auth::user()->id)->where('is_customer_lty', 1)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.major_customer', 
                compact('supplier_mc', 'supplier_lty'));

        }

        if( $request->section == 'financial_status' ) {

            $data = SupplierFinancialStatus::where('supplier_id', Auth::user()->id)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.financial_status', compact('data'));

        }

        if( $request->section == 'paypment_terms' ) {

            $data = SupplierPaymentTerms::where('supplier_id', Auth::user()->id)->get();

            return view('theme.pmc_sms.supplier-portal.pages.supplier.sections.paypment_terms', compact('data'));

        }

        if( $request->section == 'attachments' ) {

            $sd = SupplierDetails::where('supplier_id', Auth::user()->id)
                ->first();
            $attachments = explode(",", $sd->attachments);

            $data[$request->section] = [
                'model' => 'SupplierDetails',
                'data'  => $attachments
            ];

        }

    }


    public function requestUpdateSectionn (Request $request) 
    {
        return $request->all();
    }
    


    // public function checkiSuppDetailsUpdate($request) {

    //     $key_list = ['tin', 'date_established', 'website', 'organization_type', 'business_type', 
    //                   'unit', 'block', 'street', 'subdivision', 'city', 'province', 'country', 
    //                   'zip', 'attachments', 'business_style'];

        

    //     $supplier_details = SupplierDetails::where('supplier_id', Auth::user()->id)->first()->toArray();

    //     foreach( $supplier_details as $key => $value ) {

    //         if( in_array($key, $key_list) ) {

    //             if( $value != $request->$key ) {

    //                 $updates = new SupplierTempUpdate;

    //             }

    //         }

    //     }


    // }

    public function sendMessage (Request $request) 
    {

        Message::create($request->all());

        $receiver = User::where('email', $request->to)->first();
        $sender = User::where('email', $request->from)->first();
        
        if($receiver->role_id == env('APPROVER_ID')) {

            // send to approver
            Mail::to($receiver->email)->send(new MessageSentToApproverNotification($receiver,Setting::info(), $sender));


        } else {

            // send to supplier
            Mail::to($receiver->email)->send(new MessageSentToSupplierNotification($receiver,Setting::info()));

        }

        return response()->json(['status' => 'success', 'message' => 'Message Successfully Send']);

    }


    public function messages () 
    {

        $page = new Page();
        $page->name = 'Messages';

        $messages = Message::where('to', Auth::user()->email)
            ->orderBy('is_read','ASC')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy('to');

        return view('theme.pmc_sms.supplier-portal.pages.supplier.messages.index', compact('messages', 'page'));

    }
    

    public function getConvo ($email) 
    {

        $user = User::where('email', Auth::user()->email);
        $convo = Message::where(function($query) use  ($email){
                $query->where('to', Auth::user()->email)
                    ->where('from', $email);
            })->orWhere(function($query) use ($email) {
                $query->where('to', $email)
                    ->where('from', Auth::user()->email);
            })
            ->get();

        foreach($convo as $c){
            if($c->to == Auth::user()->email) {
                $c->is_read = 1;
                $c->save();
            }
        }

        return view('theme.pmc_sms.supplier-portal.pages.supplier.messages.messages', compact('convo'));
    }

    public function submit_to_approver(User $supplier){

        // validate supplier details
        // if(!$this->checkiList($supplier)) return back();


        // create approval record
        $approval_exist = false;
        $approval = Approvals::where('supplier_id', $supplier->id)->first();
        $supplier_d = $supplier->supplier_details;
        
        if($approval) {

            $onhold_step = ApproverSteps::where('approval_id', $approval->id)
                ->where('status', 'Hold')
                ->first();
            if($onhold_step){
                $onhold_step->status = 'Pending';
                $onhold_step->save();

                SupplierDetails::where('supplier_id',$supplier->id)->update(['is_editable' => 0]);

                // create approval history data
                $history = ApprovalHistory::create([
                    'user_id' => Auth::id(),
                    'action' => 'Re submit Profile',
                    'remarks' => '',
                    'approval_step_id' => 0,
                    'approval_id' => $approval->id
                ]);

                return \Redirect::route('sms.auth.profile.view',Auth::id())->with('success','Your profile was resubmitted successfully. Your profile will be locked during the approval process.');
            }

        }

        $create_approver = Approvals::create([
            'supplier_id' => $supplier->id,
            'template_id' => $supplier_d->from_classic ? 2:1,
            'submission_date' => \Carbon\Carbon::now(),
            'status' => 'Active'
        ]);

        $assign_approvers = $this->assign_approvers($supplier,$create_approver);

        // get first approver then send an email
        $first_approver = ApproverSteps::where('approval_id', $create_approver->id)
                ->where('is_current', 1)
                ->first();

        $first_approver->date_started = \Carbon\Carbon::now();
        $first_approver->save();

        $f_approver = User::find($first_approver->approver_id);
        $approver_seq = ApproverTemplates::where('approver_id', $f_approver->id)->first();
        $_cc = ApproverTemplates::where('sequence_no', 3)->first();

        if($f_approver->approver_settings->notif_for_new_suppliers){
            if( $approver_seq->sequence_no == 1 || $approver_seq->sequence_no == 2) {
                \Log::info($_cc->user->email);
                Mail::to($f_approver->email)->cc($_cc->user->email)->send(new NewSupplierApplication($f_approver,Setting::info()));
            } else {
                Mail::to($f_approver->email)->send(new NewSupplierApplication($f_approver,Setting::info()));
            }
        }

        $change_status = SupplierDetails::where('supplier_id',$supplier->id)->update(['status' => 'On-going Approval','is_editable' => 0]);

        // create approval history data
        if( Auth()->user()->supplier_details->apply_as_permanent == 1) {
            $history = ApprovalHistory::create([
                'user_id' => Auth::id(),
                'action' => 'Submit Profile Applying for Regular Supplier',
                'remarks' => '',
                'approval_step_id' => 0,
                'approval_id' => $create_approver->id
            ]);
        } else {
            $history = ApprovalHistory::create([
                'user_id' => Auth::id(),
                'action' => 'Submit Profile',
                'remarks' => '',
                'approval_step_id' => 0,
                'approval_id' => $create_approver->id
            ]);
        }

        return \Redirect::route('sms.auth.profile.view',Auth::id())->with('success','Successfully submitted your profile. Your profile will be locked during the approval process.');
    }

    public function assign_approvers($supplier,$approval){

        $approvers = ApproverTemplates::where('template_id',$approval->template_id)->orderBy('sequence_no')->get();

        foreach($approvers as $approver){

            $approver_steps = ApproverSteps::create([
                'approver_id' => $approver->approver_id,
                'status' => 'Pending',
                'approval_id' => $approval->id,
                'is_current' => ($approver->sequence_no == 1) ? 1 : 0,
                'overridable' => $approver->overridable,
                'sequence'  => $approver->sequence_no
            ]);
        }

    }
    

    public function checkiList($supplier) {

        // required array
        $required_data = [];
        $_local_req = ['bir','mayors permit', 'sample official receipt', 'company profile'];
        $_global_req = ['company profile', 'sample invoice', 'general information', 'business documents'];


        // supplier details such as date established and tin for domestic suppplier
        $supplier_details           = $supplier->supplier_details;
        $supplier_officers          = $supplier->supplier_officers;
        $supplier_contacts          = $supplier->supplier_contacts;
        $supplier_bank_d            = $supplier->supplier_banks;
        $supplier_requirements      = $supplier->supplier_requirements;
        $supplier_mc                = $supplier->supplier_customers()->where('is_customer_lty', 0)->get();
        $supplier_lty               = $supplier->supplier_customers()->where('is_customer_lty', 1)->get();
        $supplier_services          = $supplier->supplier_services;
        $supplier_req               = $supplier->supplier_requirements;

        if($supplier_details->organization_type == 'sole proprietorship') {
            $_local_req[] = 'dti';
        } else {
            $_local_req[] = 'sec';
        }

        if( $supplier_details->country == 'Philippines' || $supplier_details->country == 'PH' ) {
            $_req = $_local_req;
        } else {
            $_req = $_global_req;
        }


        if( is_null($supplier_details->tin) ) 
            return false;

        if( is_null($supplier_details->date_established) )
            return false;

        if( count($supplier_mc) < 3 )
            return false;

        if( count($supplier_lty) < 3 ) 
            return false;

        if( count($supplier_officers) == 0 )
            return false;

        if( count($supplier_contacts) == 0 )
            return false;

        if( count($supplier_bank_d) == 0 )
            return false;

        if( count($supplier_services) == 0 )
            return false;


        $gen_req_submitted = true;

        if( count($supplier_req) ) {
            foreach( $supplier_req as $req) {
                if(!in_array($req, $_req)){
                    $gen_req_submitted = false;
                    break;
                }
            }
        } 

        if(!$gen_req_submitted) return false;

        return true;

    }


    // upload file

    public function upload_file_to_temporary_storage($file)
    {
        $temporaryFolder = 'temporary_sis_attachment'.auth()->id();
        $fileName = $file->getClientOriginalName();
        $fileName = str_replace(',','_', $fileName);
        // if (Storage::disk('public')->exists($temporaryFolder.'/'.$fileName)) {
        //     $fileName = $this->make_unique_file_name($temporaryFolder, $fileName);
        // }

        $this->delete_file_if_exist($temporaryFolder, $fileName);

        $path = Storage::disk('public')->putFileAs($temporaryFolder, $file, $fileName);
        $url = Storage::disk('public')->url($path);

        return [
            'path' => $temporaryFolder.'/'.$fileName,
            'name' => $fileName,
            'url' => $url
        ];
    }

    public function make_unique_file_name($folder, $fileName)
    {
        $fileNames = explode(".", $fileName);
        $count = 2;
        $newFilename = $fileNames[0].' ('.$count.').'.$fileNames[1];
        while(Storage::disk('public')->exists($folder.'/'.$newFilename)) {
            $count += 1;
            $newFilename = $fileNames[0].' ('.$count.').'.$fileNames[1];
        }
        return $newFilename;
    }

    public function delete_file_if_exist($folder, $fileName)
    {

        if(Storage::exists($folder.$fileName)) {          
            Storage::disk('public')->delete($folder.$fileName);
        } 

    }

    public function upload(Request $request)
    {
        if ($request->hasFile('banner')) {

            $newFile = $this->upload_file_to_temporary_storage($request->file('banner'));

            return response()->json([
                'status' => 'success',
                'image_url' => $newFile['url'],
                'image_name' => $newFile['name'],
                'image_path' => $newFile['path'],
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'image_url' => '',
            'image_name' => ''
        ]);
    }    

    public function move_banner_to_official_folder($banner)
    {

        $temporaryPath = 'temporary_sis_attachment'.auth()->id();
        $fileName = $banner->getClientOriginalName();
        $fileName = str_replace(',', '_', $fileName);
        $bannerFolder = '';

        return $this->move_to_banners_folder($temporaryPath, $fileName);

    }

    public function move_to_banners_folder($temporaryPath, $fileName)
    {

        $folder = 'images/supplier/profile'.auth()->id()."/supplier-details/attachment/";

        // if (Storage::disk('public')->exists($folder)) {
        //     $fileName = $this->make_unique_file_name($folder, $fileName);
        // }

        $this->delete_file_if_exist($folder, $fileName);

        Storage::disk('public')->copy($temporaryPath."/".$fileName, $folder.$fileName);
        return Storage::disk('public')->url($folder.$fileName);
    }

    public function get_banner_path_in_storage($path)
    {
        $paths = explode('storage/', $path);

        if (count($paths) == 1) {
            return '';
        }

        return explode('storage/', $path)[1];
    }

    public function get_banner_file_name($path)
    {
        $temporaryFolder = 'temporary_sis_attachment'.auth()->id();
        return explode($temporaryFolder, $path)[1];
    }

    public function delete_temporary_banner_folder()
    {
        $temporaryFolder = 'temporary_sis_attachment'.auth()->id();
        Storage::disk('public')->deleteDirectory($temporaryFolder);
    }

    public function removeUploadedFile(Request $request) {

        $user = Auth::user();

        $exploded_img = [];

        if($request->from == 'gen_attachment') {

            $this->removeGenAttachment($user, $request);
        
        } else if( $request->from == 'controlled comm') {

            $this->removeGenReqAttachment($user, $request);
            $name = str_replace("_", " ", $request->key);
            $controoler_comm = SupplierCertifications::where('supplier_id', trim($user->id))
                ->where('name', trim($name))->first();

            $controoler_comm->attachment = "";
            $controoler_comm->save();

        } else if( $request->from == 'financial status') {

            $this->removeGenReqAttachment($user, $request);
            $name = str_replace("_", " ", $request->key);
            $controoler_comm = SupplierFinancialStatus::where('supplier_id', trim($user->id))
                ->where('name', trim($name))->first();

            $controoler_comm->attachment = "";
            $controoler_comm->save();

        } else {

            $this->removeGenReqAttachment($user, $request);

            $name = str_replace("_", " ", $request->key);
            if($name != 'philhealth'){
                $name = str_replace("ph", "", $name);
            }
            $gen_req = SupplierRequirements::where('supplier_id', trim($user->id))
                ->where('name', trim($name))->first();

            $gen_req->attachment = "";
            $gen_req->save();

        }

        return "yes";

    }


    public function removeGenAttachment($user, $request) {

        $folder = '/images/supplier/profile'.$user->id."/supplier-details/attachment/";

        if($user->supplier_details) {

            if(!is_null($user->supplier_details->attachments)) {

                $exploded_img = explode(",", $user->supplier_details->attachments);
                $key = 0;
                foreach( $exploded_img as $img ) {

                    if($request->img == $img) {

                        unset($exploded_img[$key]);
                        $this->delete_file_if_exist($folder, trim($img));
                        break;

                    }
                    $key++;
                }

            }

        }

        $attachments = null;

        if(count($exploded_img)>0) {

            $attachments = implode(",", $exploded_img);

        }

        $user->supplier_details->attachments = $attachments;
        $user->supplier_details->save();

        return true;

    }

    public function removeGenReqAttachment($user, $request) {

        $folder = '/images/supplier/profile'.$user->id."/supplier-details/attachment/";

        $this->delete_file_if_exist($folder, trim($request->img));

        return true;

    }

}
