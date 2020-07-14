<?php

namespace App\Http\Controllers\Front;

use App\Deal;
use App\Store;
use App\Category;
use App\SubCategory;
use App\ChildCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DealsCatalogController extends Controller
{   

    private function getCategoriesDeals ($page=1, $catSlug=null, $subCatSlug=null, $childCatSlug=null) 
    {   
        $data = [];

        $perPage = 3;
        $offset = ( ( $page - 1 ) * $perPage );

        $cat = null;
        $subcat = null;
        $childcat = null;

        if (!empty($catSlug)) {
            $cat = Category::where('slug', $catSlug)->firstOrFail();
            $data['cat'] = $cat;
        }

        if (!empty($subCatSlug)) {
            $subcat = SubCategory::where('slug', $subCatSlug)->firstOrFail();
            $data['subcat'] = $subcat;
        }

        if (!empty($childCatSlug)) {
            $childcat = ChildCategory::where('slug', $childCatSlug)->firstOrFail();
            $data['childcat'] = $childcat;
        }

        $deals = Deal::when($cat, function ( $query, $cat ) {
            return $query->where('category_id', $cat->id);
        })
        ->when($subcat, function ($query, $subcat) {

            return $query->where('subcategory_id', $subcat->id);

        })->when($childcat, function ($query, $childcat) {

            return $query->where('childcategory_id', $childcat->id);

        });

        $data['deals'] = $deals->with('code', 'coupon')->orderBy('id', 'DESC')->offset($offset)->limit($perPage)->get();

        return $data;

    }

    private function getStoreDeals ($page=1, $slug)
    {   
        $data = [];

        $perPage = 3;
        $offset = ( ( $page - 1 ) * $perPage );

        $store = Store::where('slug', $slug)->firstOrFail();
        $data['store'] = $store;

        $data['deals'] = Deal::where('store_id', $store->id)->with('code', 'coupon')
        ->orderBy('id', 'DESC')->offset($offset)->limit($perPage)->get();

        return $data;
    }

    // category
    public function category($catSlug=null, $subCatSlug=null, $childCatSlug=null) 
    {   
        
        $data = [];
    
        $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
        $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

        $dealsData = $this->getCategoriesDeals($page=1, $catSlug, $subCatSlug, $childCatSlug);
        $data = array_merge($data, $dealsData);
        $data['categories'] = $categories;
        $data['onlyParentCategories'] = $onlyParentCategories; 
        $data['stores'] = Store::all();

    
        return view('public.deals.index', $data);
        
    }

    // store
    public function store ($slug) 
    {   
        $data = [];

        $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
        $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

        $dealsData = $this->getStoreDeals($page=1, $slug);
        $data = array_merge($data, $dealsData);
        $data['categories'] = $categories;
        $data['onlyParentCategories'] = $onlyParentCategories; 
        $data['stores'] = Store::all();

        
        return view('public.deals.stores.index', $data);
    }


    // load more category deals
    public function loadMoreCategoryDeals ($page, $catSlug=null, $subCatSlug=null, $childCatSlug=null)
    {
        
        if(!$this->is_ajax_request()) { exit; }


        $dealsData = $this->getCategoriesDeals($page, $catSlug, $subCatSlug, $childCatSlug);
        
        return view('public.deals.ajax-response.deals' , [
            'deals' => $dealsData['deals']
        ]);

    }

    // load more store deals
    public function loadMoreStoreDeals ($page, $slug) 
    {
        if(!$this->is_ajax_request()) { exit; }

        $dealsData = $this->getStoreDeals($page, $slug);

        return view('public.deals.ajax-response.deals' , [
            'deals' => $dealsData['deals']
        ]);

    }

    // load more all deals
    public function loadMoreDeals ($page)
    {
        if(!$this->is_ajax_request()) { exit; }

        $perPage = 20;
        $offset = ( ( $page - 1 ) * $perPage );

        $deals = Deal::with('code', 'coupon')->orderBy('id', 'DESC')->offset($offset)->limit($perPage)->get();

        return view('public.deals.ajax-response.deals' , [
            'deals' => $deals
        ]);
    }

    // filter deals


    // search deals
    

    public function dealDetails ($slug) 
    {
        $data = [];

        $deal = Deal::whereSlug($slug)->with('code', 'coupon', 'category', 'subcategory', 'childcategory', 'store')->first();

        $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
        $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

        $data['deal'] = $deal;
        $data['categories'] = $categories;
        $data['onlyParentCategories'] = $onlyParentCategories; 
        $data['stores'] = Store::all();

        return  view('public.deals.show', $data);
    }

    // Determine Ajax request
    public function is_ajax_request() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
          $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }

    
}
