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
use App\SupplierModels\ApproverTemplates;

class TemplateStepsController extends Controller
{
    private $searchFields = ['id'];

    public function __construct()
    {
        Permission::module_init($this, 'approver-steps');
    }    

    public function index()
    {
        $steps = ListingHelper::simple_search(ApproverTemplates::class, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('admin.supplier.template.index',compact('steps','filter', 'searchType'));
    }

    public function create()
    {

        $approvers = User::where('role_id', env('APPROVER_ID'))
            ->get();

        return view('admin.supplier.template.create', compact('approvers'));
    }

    
    public function store(Request $request)
    {

        // $this->validate($request, [
        //     'approver'      => 'unique:approver_templates,approver_id|required' ,
        //     'sequence'      => 'unique:approver_templates,sequence_no|required'            
        // ]);

        $imploded_overridable = '';

        if(isset($request->overridable)) {
            $imploded_overridable = implode(",", $request->overridable);
        }

        ApproverTemplates::create([
            'approver_id'   => $request->approver ,
            'template_id'   => 1 ,
            'sequence_no'   => $request->sequence , 
            'level'         => $request->sequence , 
            'overridable'   => $imploded_overridable
        ]);

        return redirect()->route('approver-steps.index')->with('success', 'The Approver Template Step has been created');
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

        $approvers = User::where('role_id', env('APPROVER_ID'))
            ->get();

        $step = ApproverTemplates::findOrFail($id);

        return view('admin.supplier.template.edit',compact('step','approvers'));
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

        // $this->validate($request, [
        //     'approver'      => 'unique:approver_templates,approver_id,'.$request->approver.',id,'.$id.'|required' ,
        //     'sequence'      => 'unique:approver_templates,sequence_no,'.$request->sequence.',id,'.$id.'|required'
        // ]);

        $imploded_overridable = '';
//        dd('aw');
        if(isset($request->overridable)) {
            $imploded_overridable = implode(",", $request->overridable);
        }

        $step = ApproverTemplates::findOrFail($id);

        $supplier->update([
            'approver_id'   => $request->approver ,
            'template_id'   => 1 ,
            'sequence_no'   => $request->sequence , 
            'level'         => $request->sequence , 
            'overridable'   => $imploded_overridable
        ]);

        return back()->with('success','The Approver Step has been updated.');
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
        $applicant = ApproverTemplates::findOrFail($request->id);
        $applicant->delete();

        return back()->with('success', 'The Approver Step has been deleted.');
    }

    public function delete(Request $request)
    {
        //logger($request);
        $pages = explode("|",$request->pages);

        foreach($pages as $page){
            ApproverTemplates::whereId($page)->delete();
        }

        return back()->with('success', 'The Approver Step has been deleted.');
    }

    public function restore($id){
        ApproverTemplates::whereId($id)->restore();

        return back()->with('success', 'The Approver Step has been restored.');

    }

    public function get_slug(Request $request)
    {
        return ModelHelper::convert_to_slug(ApproverTemplates::class, $request->url);
    }
}
