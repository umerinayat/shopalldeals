<?php

namespace App\Http\Controllers;

use App\SubCategory;
use App\ChildCategory;
use App\Http\Requests\StoreChildCategory;
use App\Http\Requests\UpdateChildCategory;
use Illuminate\Http\Request;

class ChildCategoriesController extends Controller
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
        $childCategories = ChildCategory::orderBy('id', 'ASC')->get();
        $data['childCategories'] = $childCategories;
        return view('admin.categories.sub_categories.child_categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.sub_categories.child_categories.create', [
            'subCategories' => SubCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildCategory $request)
    {
        $childCategory = ChildCategory::storeChildCategory($request->all());
        return redirect()->action('ChildCategoriesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ChildCategory $childCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildCategory $childCategory)
    {
        $data = [];
        $data['subCategories'] = SubCategory::all();
        $data['childCategory'] = $childCategory;
        return view('admin.categories.sub_categories.child_categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChildCategory $request, ChildCategory $childCategory)
    {
        $childCategory = ChildCategory::updateChildCategory($request->all(), $childCategory);
        return redirect()->action('ChildCategoriesController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChildCategory  $childCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChildCategory $childCategory)
    {
        //
        $childCategory->delete();
        return redirect()->action('ChildCategoriesController@index');
    }
}
