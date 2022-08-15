<?php

namespace App\Http\Controllers;

use App\EmailRecipient;
use Facades\App\Helpers\ListingHelper;
use App\Helpers\Webfocus\Setting;
use App\Http\Requests\ContactUsRequest;
use App\Mail\InquiryAdminMail;
use App\Mail\InquiryMail;
use App\Page;
use Auth;
use App\Subscriber;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\SupplierModels\SupplierDetails;
use Illuminate\Support\Collection;

class FrontController extends Controller
{
    public function home()
    {
        return $this->page('home');
    }

    public function privacy_policy()
    {
        $footer = Page::where('slug', 'footer')->where('name', 'footer')->first();

        $page = new Page();
        $page->name = Setting::info()->data_privacy_title;

        return view('theme.'.env('FRONTEND_TEMPLATE').'.main.pages.privacy-policy', compact('page', 'footer'));
    }

    public function contact_page()
    {
        $page = new Page();
        
        return view('theme.'.env('FRONTEND_TEMPLATE').'.main.pages.contact-us.contact-us', compact('page'));
    }

    public function search(Request $request)
    {
        $searchFields = ['name', 'label', 'contents'];

        $searchPages = ListingHelper::simple_search(Page::class, $searchFields);

        $filter = ListingHelper::get_filter($searchFields);

        $page = new Page();
        $page->name = 'Search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.main.pages.search', compact('searchPages', 'filter', 'page'));
    }

    public function page($slug)
    {

        if (Auth::guest()) {
            $page = Page::where('slug', $slug)->where('status', 'PUBLISHED')->first();
        } else {
            $page = Page::where('slug', $slug)->first();
        }
        if ($page == null) {
            $view404 = 'theme.'.env('FRONTEND_TEMPLATE').'.main.pages.404';
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
            return view('theme.'.env('FRONTEND_TEMPLATE').'.main.pages.'.$page->template, compact('footer', 'page', 'breadcrumb'));
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

        return view('theme.'.env('FRONTEND_TEMPLATE').'.main.main', compact('page', 'parentPage', 'breadcrumb', 'currentPageItems', 'parentPageName'));
    }

    public function contact_us(ContactUsRequest $request)
    {
        $client = $request->all();

        Mail::to(Setting::info()->email)->send(new InquiryMail(Setting::info(), $client));

        $recipientEmails = EmailRecipient::email_list();
        foreach ($recipientEmails as $email) {
            Mail::to($email)->send(new InquiryAdminMail(Setting::info(), $client));
        }

        if (Mail::failures()) {
            return redirect()->back()->with('error', 'Failed to send inquiry. Please try again later.');
        }

        return redirect()->back()->with('success', 'Success! Your inquiry has been sent.');
    }

    public function breadcrumb($page)
    {
        return [
            'Home' => url('/'),
            $page->name => url('/').'/'.$page->slug
        ];
    }


    public function goSearch (Request $request) 
    {   
        if(!Auth::user()) return redirect()->back();
        if(isset($request->advance_search)) {
            $isNull = true;
            $suppliers = User::where('role_id', env('SUPPLIER_ID'));

            if(!is_null($request->company_name)) {               
                $suppliers->join('supplier_details', function($join) use ($request){
                    $join->on('users.id','=','supplier_details.supplier_id')
                        ->where('company_name', 'like', "%{$request->company_name}%");
                });
                $isNull = false;
            }

            if(!is_null($request->business_lines)) {
                $suppliers->join('supplier_services', function($join) use ($request){
                    $join->on('users.id','=','supplier_services.supplier_id')
                        ->where('name', 'like', "%{$request->business_lines}%");
                });
                $isNull = false;
            }

            if(!is_null($request->contact_person) && is_null($request->position)) {
                $suppliers->join('supplier_officers', function($join) use ($request){
                    $join->on('users.id','=','supplier_officers.supplier_id')
                        ->where('supplier_officers.name', 'like', "%{$request->contact_person}%");
                });
                $isNull = false;
            } 

            if(!is_null($request->contact_person) && !is_null($request->position)) {
                $suppliers->join('supplier_contact_details', function($join) use ($request){
                    $join->on('users.id','=','supplier_contact_details.supplier_id')
                        ->where('supplier_contact_details.name', 'like', "%{$request->contact_person}%")
                        ->orWhere('supplier_contact_details.position','like', "%{$request->position}%");
                });
                $isNull = false;
            }

            if(!$isNull){

                $suppliers = SupplierDetails::whereIn('supplier_id', $suppliers->get()->unique('users.id')->pluck('supplier_id'))
                    ->paginate(15);

                //$this->paginate($suppliers->get()->unique('users.id'), $perPage = 15, $page = null, $options = []);
            } else {
                $suppliers = [];
            }

        } else {
            $suppliers = SupplierDetails::where('company_name', 'like', "%{$request->keyword}%")
                ->get();

            if(!count($suppliers)) {
                $suppliers = SupplierBusinessLines::where('name', 'like', "%{$request->keyword}%")->get();
            }

            $suppliers = SupplierDetails::whereIn('supplier_id', $suppliers->unique('supplier_id')->pluck('supplier_id'))
                    ->paginate(15);
        }

        $page = new Page();
        $page->name = 'Search';

        return view('theme.'.env('FRONTEND_TEMPLATE').'.supplier-portal.pages.search', compact('page', 'suppliers'));

    }

    public function paginate($items, $perPage = 15, $page = null, $options = []) {
        $page = $page ?: (\Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new \Illuminate\Pagination\LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function subscriber(Request $request) {

        Subscriber::create($request->except('_token'));
        
        $message_success = 'Email Successfully Subscribe.';
        
        return response()->json(["alert" => "success", "message" => $message_success]);

    }


}
