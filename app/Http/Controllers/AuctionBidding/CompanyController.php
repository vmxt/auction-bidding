<?php

namespace App\Http\Controllers\AuctionBidding;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use App\Role;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = new \App\Page;
        $page->name = 'Company';
        $companies = Company::paginate(10);
        
        return view('theme.pmc_sms.auction-bidding.company.index', compact('page', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = new \App\Page;
        $page->name = 'Create Company';

        return view('theme.pmc_sms.auction-bidding.company.crud', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = Company::create($request->validate([
            'name' => 'unique:companies',
            'office_address' => 'required',
            'contact_person' => 'required',
            'email_address' => 'email',
            'mobile_number' => 'integer',
            'contact_number' => 'integer'
        ]));
        
        return back()->with('success', 'Company has been successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = new \App\Page;
        $page->name = 'View Edit Company';
        $company = Company::with(['branches', 'users.role'])->find($id);
        $roles = Role::all();

        return view('theme.pmc_sms.auction-bidding.company.show', compact('page', 'company', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = new \App\Page;
        $page->name = 'Edit Company';
        $company = Company::find($id);

        return view('theme.pmc_sms.auction-bidding.company.crud', compact('company', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id)->update($request->validate([
            'name' => 'required',
            'office_address' => 'required',
            'contact_person' => 'required',
            'email_address' => 'email',
            'mobile_number' => 'integer',
            'contact_number' => 'integer'
        ]));
        
        return back()->with('success', 'Company has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id)->delete();

        return back()->with('success', 'Company has been successfully deleted!');
    }

    public function autocomplete(Request $request)
    {
        $data = Company::select("name")
                ->where("name","LIKE","%{$request->get('query')}%")
                ->get();
   
        return response()->json($data);
    }
}
