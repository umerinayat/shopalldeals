<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\ChildCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories = Category::orderBy('order', 'ASC')->get();
        $data['categories'] = $categories;
        return view('admin.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\StoreCategory $request)
    {
        $category = Category::storeCategory($request->all());
        return redirect()->action('CategoryController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {   
        $data = [];
        $data['category'] = $category;
        return view('admin.categories.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\UpdateCategory $request, Category $category)
    {
        $category = Category::updateCategory($request->all(), $category);
        return redirect()->action('CategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->action('CategoryController@index');
    }

    // get subCategories
    public function getSubCategories ( $category_id )
    {
        if( !$this->is_ajax_request() ) 
        {
            return [
                'success' => false,
                'subCategories' => []
            ];
        } 
        else 
        {
            $selectOptionsHtml = '';

            $subCategories = SubCategory::where('category_id', $category_id)->get();
            if (count ($subCategories) > 0 )
            {
                foreach ( $subCategories as $subCat ) 
                {
                    $selectOptionsHtml .= '<option ';
                    $selectOptionsHtml .= 'value="' . $subCat->id . '"';
                    $selectOptionsHtml .= '>';
                    $selectOptionsHtml .= $subCat->name;
                    $selectOptionsHtml .= '</option>';
                }

                return [
                    'success' => true,
                    'optionsHtml' => $selectOptionsHtml
                ];
            } 
            else 
            {
                return [
                    'success' => true,
                    'optionsHtml' => false
                ];
            }

          
        } 
    }
    
    // get childCategories
    public function getChildCategories ( $subcategory_id )
    {

        if( !$this->is_ajax_request() ) 
        {
            return [
                'success' => false,
                'childCategories' => []
            ];
        } 
        {
            $selectOptionsHtml = '';

            $childCategories = ChildCategory::where('sub_category_id', $subcategory_id)->get();
            if (count ($childCategories) > 0 )
            {
                foreach ( $childCategories as $childCat ) 
                {
                    $selectOptionsHtml .= '<option ';
                    $selectOptionsHtml .= 'value="' . $childCat->id . '"';
                    $selectOptionsHtml .= '>';
                    $selectOptionsHtml .= $childCat->name;
                    $selectOptionsHtml .= '</option>';
                }

                return [
                    'success' => true,
                    'optionsHtml' => $selectOptionsHtml
                ];
            } 
            else 
            {
                return [
                    'success' => true,
                    'optionsHtml' => false
                ];
            }

          
        } 

    }
    
    // detect ajax request
    private function is_ajax_request() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
        }

}
