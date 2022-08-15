<?php

namespace App\Http\Controllers\SupplierPortal\Admin;

use Facades\App\Helpers\ListingHelper;
use App\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\SupplierModels\SupplierCategoryMaster;
use App\SupplierModels\SupplierCategoriesCustomFields;
use App\Permission;
use App\SupplierModels\Supplier;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    private $searchFields = ['email'];

    public function __construct()
    {
        Permission::module_init($this, 'supplier');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Supplier::where('role_id',2);
        $suppliers = ListingHelper::simple_search_using_collection($data, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('admin.supplier.accredited.index',compact('suppliers','filter', 'searchType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = SupplierCategoryMaster::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent ?? 0
        ]);

        return redirect()->route('supplier-categories.index')->with('success', 'The Supplier has been created.');
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
        return "not sure if this part is available for admin to edit";
        $supplier = SupplierCategoryMaster::findOrFail($id);

        return view('admin.supplier.category.edit',compact('supplier'));
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
        $supplier = SupplierCategoryMaster::findOrFail($id);

        $supplier->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent ?? 0
        ]);

        return back()->with('success','The Supplier has been updated.');
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
        $articleCategory = Supplier::findOrFail($request->id);
        //$articleCategory->update([ 'user_id' => auth()->user()->id ]);
        $articleCategory->delete();

        return back()->with('success', 'The Supplier has been deleted.');
    }

    public function delete(Request $request)
    {
        //logger($request);
        $pages = explode("|",$request->pages);

        foreach($pages as $page){
            //ArticleCategory::whereId($page)->update(['user_id' => auth()->user()->id ]);
            Supplier::whereId($page)->delete();
        }

        return back()->with('success', 'The Supplier has been deleted.');
    }

    public function restore($id){
        //ArticleCategory::withTrashed()->find($id)->update(['user_id' => auth()->user()->id ]);
        Supplier::whereId($id)->restore();

        return back()->with('success', 'The Supplier has been restored.');

    }

    public function get_slug(Request $request)
    {
        return ModelHelper::convert_to_slug(Supplier::class, $request->url);
    }
}
