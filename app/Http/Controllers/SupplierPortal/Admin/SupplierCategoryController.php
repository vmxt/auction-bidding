<?php

namespace App\Http\Controllers\SupplierPortal\Admin;

use Facades\App\Helpers\ListingHelper;
use App\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\SupplierModels\SupplierCategoryMaster;
use App\SupplierModels\SupplierCategoriesCustomFields;
use App\Permission;
use Illuminate\Http\Request;


class SupplierCategoryController extends Controller
{
    private $searchFields = ['name'];

    public function __construct()
    {
        Permission::module_init($this, 'supplier_category_master');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $categories = ListingHelper::simple_search(SupplierCategoryMaster::class, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        return view('admin.supplier.category.index',compact('categories','filter', 'searchType'));
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

        $this->validate($request, [
            'name'  => 'required' ,
            'description'   => 'required' 
        ]);

        $category = SupplierCategoryMaster::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent ?? 0
        ]);

        return redirect()->route('supplier-categories.index')->with('success', 'The Supplier Category has been created.');
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

        $this->validate($request, [
            'name'  => 'required' ,
            'description'   => 'required'
        ]);
        
        $supplier = SupplierCategoryMaster::findOrFail($id);

        $supplier->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent ?? 0
        ]);

        return back()->with('success','The Supplier Category has been updated.');
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
        $supp_category = SupplierCategoryMaster::findOrFail($request->id);
//        $supp_category->update([ 'user_id' => auth()->user()->id ]);
        $supp_category->delete();

        return back()->with('success', 'The Supplier Category has been deleted.');
    }

    public function delete(Request $request)
    {
        //logger($request);
        $pages = explode("|",$request->pages);

        foreach($pages as $page){
//            SupplierCategoryMaster::whereId($page)->update(['user_id' => auth()->user()->id ]);
            SupplierCategoryMaster::whereId($page)->delete();
        }

        return back()->with('success', 'The Supplier Category has been deleted.');
    }

    public function restore($id){
        //SupplierCategoryMaster::withTrashed()->find($id)->update(['user_id' => auth()->user()->id ]);
        SupplierCategoryMaster::whereId($id)->restore();

        return back()->with('success', 'The Supplier Category has been restored.');

    }

    public function get_slug(Request $request)
    {
        return ModelHelper::convert_to_slug(ArticleCategory::class, $request->url);
    }
}
