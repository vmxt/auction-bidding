<?php

namespace App\Http\Controllers\SupplierPortal\Admin;

use Facades\App\Helpers\ListingHelper;
use App\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\SupplierModels\SupplierApplicants;
use App\Mail\SupplierApplicantApproved;
use App\Permission;
use Illuminate\Http\Request;
use Response;
use Auth;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\RejectedSupplierNotification;
use App\SupplierModels\SupplierDetails;


class SupplierApplicantController extends Controller
{
    private $searchFields = ['name'];

    public function __construct()
    {
        Permission::module_init($this, 'supplier_applicants');
    }    

    public function index()
    {
        $applicants = ListingHelper::simple_search(SupplierApplicants::class, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('admin.supplier.applicants.index',compact('applicants','filter', 'searchType'));
    }

    public function profile(SupplierApplicants $supplier){
        return view('admin.supplier.applicants.profile',compact('supplier'));
    }

    public function approveDisapprove(Request $request){        

        $supplier = SupplierApplicants::findOrFail($request->supplier_id);

        if($request->hidden_action == 'Approve') {

            $supplier->update([
                'status' => 'Approved',
                'approved_by' => Auth::user()->username,
                'approved_time' => \Carbon\Carbon::now() ,
                'remarks'   => $request->remarks
            ]);
        
            $create_user = $this->create_user_after_approval($supplier, $request->is_one_time);

            $send_instruction_email_to_supplier = $this->approval_email($supplier,$create_user);

            return back()->with('success','Successfully approved '.$supplier->name);

        } 
        
        $update_status = $supplier->update([
            'status' => 'Disapproved' ,
            'disapproved_by' => Auth::user()->username ,
            'disapproved_time'  => \Carbon\Carbon::now() ,
            'remarks'   => $request->remarks
        ]);

        //$supp_details = User::find($request->supplier_id);

        Mail::to($supplier->email)->send(new RejectedSupplierNotification($supplier));

        return back()->with('success',$supplier->name.'\'s application rejected');

    }


    public function disapprove ($id) 
    {

        $supplier = SupplierApplicants::findOrFail($id);
        $update_status = $supplier->update([
            'status' => 'Disapproved'
        ]);

        return back()->with('success',$supplier->name.'\'s application rejected');
        
    }
    

    public function create_user_after_approval($s, $is_one_time){
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
            'is_one_time' => $is_one_time,
            'user_id' => Auth::id()
        ]);

        return $pass;
    }

    public function approval_email($s,$u){

        Mail::to($s->email)
            ->cc([env('CC_EMAIL')])
            ->send(new SupplierApplicantApproved($s,$u));
        return;
    }

    public function approval_email1($email){
        $s = SupplierApplicants::findOrFail(3);
        $u = \Hash::make('password');
        Mail::raw($email)
            ->cc(env('CC_EMAIL'))
            ->send(new SupplierApplicantApproved($s,$u));
        return;
    }

    public function create()
    {
        return view('admin.supplier.applicants.create');
    }

    
    public function store(Request $request)
    {
        $category = SupplierApplicants::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent ?? 0
        ]);

        return redirect()->route('supplier-categories.index')->with('success', 'The Applicants has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ArticleCategory $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = SupplierApplicants::findOrFail($id);

        return view('admin.supplier.applicants.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArticleCategory  $articleCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = SupplierApplicants::findOrFail($id);

        $supplier->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent ?? 0
        ]);

        return back()->with('success','The Applicants has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ArticleCategory $articleCategory
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        $applicant = SupplierApplicants::findOrFail($request->id);
        $applicant->delete();

        return back()->with('success', 'The Applicants has been deleted.');
    }

    public function delete(Request $request)
    {
        //logger($request);
        $pages = explode("|",$request->pages);

        foreach($pages as $page){
            SupplierApplicants::whereId($page)->delete();
        }

        return back()->with('success', 'The Applicants has been deleted.');
    }

    public function restore($id){
        SupplierApplicants::whereId($id)->restore();

        return back()->with('success', 'The Applicants has been restored.');

    }

    public function get_slug(Request $request)
    {
        return ModelHelper::convert_to_slug(SupplierApplicants::class, $request->url);
    }
}
