<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Store;
use App\Deal;
use App\DealsWithCode;
use App\DealWithCoupon;


class IndexController extends Controller
{
    public function index($page=1) 
    {
        $data = [];

        $perPage = 20;
        $offset = ( ( $page - 1 ) * $perPage );

        $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
        $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

        $stores = Store::all();

        $deals = Deal::with('code', 'coupon')->orderBy('id', 'DESC')->offset($offset)->limit($perPage)->get();
        
        
        $data['onlyParentCategories'] = $onlyParentCategories; 
        $data['categories'] = $categories;
        $data['stores'] = $stores;
        $data['deals'] = $deals ;
        $data['context'] = 'index';

        return view('public.index', $data);
    }
}
