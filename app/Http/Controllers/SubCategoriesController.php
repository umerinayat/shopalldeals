<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $subCategories = SubCategory::orderBy('id', 'ASC')->get();
        $data['subCategories'] = $subCategories;
        return view('admin.categories.sub_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.categories.sub_categories.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\StoreSubCategory $request)
    {
        $subCategory = SubCategory::storeSubCategory($request->all());
        return redirect()->action('SubCategoriesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $data = [];
        $data['categories'] = Category::all();
        $data['subCategory'] = $subCategory;
        return view('admin.categories.sub_categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\UpdateSubCategory $request, SubCategory $subCategory)
    {
        $subCategory = SubCategory::updateSubCategory($request->all(), $subCategory);
        return redirect()->action('SubCategoriesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
        $subCategory->delete();
        return redirect()->action('SubCategoriesController@index');
    }
}
