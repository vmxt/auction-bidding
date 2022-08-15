<?php

namespace App\Http\Controllers\SupplierPortal;

use App\Http\Controllers\Controller;
use App\EmailRecipient;
use Facades\App\Helpers\ListingHelper;
use App\Helpers\Webfocus\Setting;
use App\Http\Requests\ContactUsRequest;
use App\Mail\InquiryAdminMail;
use App\Mail\InquiryMail;
use App\Page;
use App\Helpers\FileHelper;
use App\SupplierModels\SupplierApplicants;
use App\SupplierModels\SupplierDetails;
use App\SupplierModels\SupplierApplicantProducts;
use Auth;
use Carbon\Carbon;
use App\SupplierModels\ApproverSteps;
use App\SupplierModels\ApproverTemplates;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ApproverReminderEmail;
use App\User;

class FrontController extends Controller
{
    public function home()
    {
        return $this->page('home');
    }

    public function login()
    {
        if(Auth::user()) return redirect()->route(Auth::user()->user_role_redirect());

        $page = new Page();
        $page->name = 'Login';
        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.supplier.login',compact('page'));
    }

    public function page($slug)
    {

        if (Auth::guest()) {
            $page = Page::where('slug', $slug)->where('status', 'PUBLISHED')->first();
        } else {
            $page = Page::where('slug', $slug)->first();
        }
        if ($page == null) {
            $view404 = 'theme.'.env('FRONTEND_TEMPLATE').'.pages.404';
            if (view()->exists($view404)) {
                $page = new Page();
                $page->name = 'Page not found';
                return view($view404, compact('page'));
            }

            abort(404);
        }

        $breadcrumb = $this->breadcrumb($page);

        $footer = Page::where('slug', 'footer')->where('name', 'footer')->first();

        if (!empty($page->template)) {            
            return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.'.$page->template, compact('footer', 'page', 'breadcrumb'));
        }

        $parentPage = null;
        $parentPageName = $page->name;
        $currentPageItems = [];
        $currentPageItems[] = $page->id;
        if ($page->has_parent_page() || $page->has_sub_pages()) {
            if ($page->has_parent_page()) {
                $parentPage = $page->parent_page;
                $parentPageName = $parentPage->name;
                $currentPageItems[] = $parentPage->id;
                while ($parentPage->has_parent_page()) {
                    $parentPage = $parentPage->parent_page;
                    $currentPageItems[] = $parentPage->id;
                }
            } else {
                $parentPage = $page;
                $currentPageItems[] = $parentPage->id;
            }
        }
    
        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.page', compact('footer', 'page', 'parentPage', 'breadcrumb', 'currentPageItems', 'parentPageName'));
    }    

    public function breadcrumb($page)
    {
        return [
            'Home' => url('/'),
            'Supplier Portal' => url('/sp/'),
            $page->name => url('/').'/sp/'.$page->slug
        ];
    }

    public function register(){
        $page = new Page();
        $page->name = 'Supplier Registration';
        return view('theme.'.env('FRONTEND_TEMPLATE').'.'.env('SP_TEMPLATE').'.pages.supplier.register',compact('page'));
    }

    public function passwordReset() {
        $page = new Page();
        $page->name = 'Password Reset';
        return view('theme.pmc_sms.supplier-portal.pages.supplier.account.reset', compact('page'));
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
        
        return redirect()->route('sp.login')->with('success', 'Password successfully updated!');
    }

    public function submit_registration(Request $request){        

        $this->validate($request, [
            'company_name'  => 'required',
            'company_address'   => 'required',
            'email' => 'required|email:rfc|unique:supplier_applicants' ,
            'contact_person'    => 'required',
            'designation'   => 'required',
            'territory' => 'required',
            'commodities'   => 'required',
            'product_list'  => 'required'
            // 'uploads' => 'required' 
        ]);

        // if($request->uploads == 'Upload Image') {
        //     $this->validate($request, [
        //         'prod_description' => 'required' ,
        //         'input2' => 'required'
        //     ]);
        // } else {
        //     $this->validate($request, [
        //         'product_url1' => 'required'
        //     ]);
        // }


        $pl = explode("\r\n", $request->product_list);

        $pl = implode(",", $pl);

        $store_registration = SupplierApplicants::create([
            'name' => $request->company_name,
            'address' => $request->company_address,
            'commodities' => implode("|", $request->commodities),
            'territory' => $request->territory,
            'contact_person' => $request->contact_person,
            'designation' => $request->designation,
            'email' => $request->email,
            'email1'    => $request->has('email1') ? $request->email1 : null ,
            'email2'    => $request->has('email2') ? $request->email1 : null ,
            'email3'    => $request->has('email3') ? $request->email1 : null ,
            'email4'    => $request->has('email4') ? $request->email1 : null ,
            'designation1'    => $request->has('designation1') ? $request->designation1 : null ,
            'designation2'    => $request->has('designation2') ? $request->designation2 : null ,
            'designation3'    => $request->has('designation3') ? $request->designation3 : null ,
            'designation4'    => $request->has('designation4') ? $request->designation4 : null ,
            'contact_person1'    => $request->has('contact_person1') ? $request->contact_person1 : null ,
            'contact_person2'    => $request->has('contact_person2') ? $request->contact_person2 : null ,
            'contact_person3'    => $request->has('contact_person3') ? $request->contact_person3 : null ,
            'contact_person4'    => $request->has('contact_person4') ? $request->contact_person4 : null 
        ]);

        $store_products = SupplierApplicantProducts::create([
            'description' => $pl, 
            'applicant_id' => $store_registration->id           
        ]);


        // for($x=1; $x<=10; $x++ ){
        //     if(strlen($request->input('product_url'.$x))>0){
        //         $store_products = SupplierApplicantProducts::create([
        //             'url' => $request->input('product_url'.$x),
        //             'applicant_id' => $store_registration->id                         
        //         ]);
        //     }
        // }

        // $x=0;
        // if($request->hasFile('input2')){
        //     foreach($request->input2 as $photo){
        //         if(strlen($photo)>0){
        //             $x++;
        //             $desc = ($x == 1) ? $request->prod_description : '';
        //             $file = new Filehelper();
        //             $upload = $file->move_to_folder($photo, 'supplier/applicants/'.$store_registration->id);
                
        //             $store_products = SupplierApplicantProducts::create([
        //                 'url' => $upload['url'],   
        //                 'name' => $upload['name'],  
        //                 'file_url' => $upload['path'],  
        //                 'description' => $desc, 
        //                 'applicant_id' => $store_registration->id             
        //             ]);
        //         }
        //     }
        // }

        return back()->with('success','successfully saved');
    }

    public function checkApprovalProgress() {

        $approvals = ApproverSteps::where('is_current', 1)
            ->where('status', 'pending')
            ->orWhere('status', 'hold')
            ->where('date_started', '=', Carbon::now()->subDays(2)->toDateString())
            ->orWhere('date_started', '=', Carbon::now()->subDays(5)->toDateString())
            ->orWhere('date_started', '=', Carbon::now()->subDays(10)->toDateString())
            ->get()
            ->groupBy('approver_id');

        foreach( $approvals as $key => $approval ) {

            $approver = User::find($key);

            if($approver->approver_sequence->sequence_no <= 3) {
                // send to mcd manager
                $approver3 = ApproverTemplates::where('sequence_no', 3)->first();
                $sendTo = User::find($approver3->approver_id);
                Mail::to($sendTo->email)->send(new ApproverReminderEmail($sendTo, Setting::info(), $approval));
            } elseif ($approver->approver_sequence->sequence_no > 3 && $approver->approver_sequence->sequence_no <= 6 ) {
                // send to accounting manager
                $approver6 = ApproverTemplates::where('sequence_no', 6)->first();
                $sendTo = User::find($approver6->approver_id);
                Mail::to($sendTo->email)->send(new ApproverReminderEmail($sendTo, Setting::info(), $approval));
            }

            

        }

    }

    public function validateEmail(Request $request) {

        $applicant_email = SupplierApplicants::where('email', $request->email)->first();

        $user_email = User::where('email', $request->email)->first();

        if( $applicant_email || $user_email ) {
            return response()->json(['success' => true, 'exist' => true]);
        }

        return response()->json(['success' => true, 'exist' => false]);

    }

    public function validateVendor(Request $request) {

        $applicant_email = SupplierApplicants::where('name', $request->name)->first();

        $applicants = SupplierDetails::where('company_name', $request->name)->first();

        if( $applicant_email || $applicants ) {
            return response()->json(['success' => true, 'exist' => true]);
        }

        return response()->json(['success' => true, 'exist' => false]);

    }

}
