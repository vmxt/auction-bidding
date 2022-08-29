<?php

namespace App\Http\Controllers\AuctionBidding;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branch = Branch::create($request->validate([
            'company_id' => 'required',
            'name' => 'required',
            'region' => 'nullable',
            'city' => 'nullable',
            'full_address' => 'nullable',
            'landline' => 'nullable|integer',
            'mobile_number' => 'nullable|integer',
            'email_address' => 'nullable|email',
            'contact_person' => 'nullable'
        ]));

        return back()->with('success', 'Branch has been successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $branch = Branch::find($id)->update($request->validate([
            'company_id' => 'required',
            'name' => 'required',
            'region' => 'nullable',
            'city' => 'nullable',
            'full_address' => 'nullable',
            'landline' => 'nullable|integer',
            'mobile_number' => 'nullable|integer',
            'email_address' => 'nullable|email',
            'contact_person' => 'nullable'
        ]));

        return back()->with('success', 'Branch has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch = Branch::find($id)->delete();

        return back()->with('success', 'Branch has been successfully deleted!');
    }
}
