<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Deal;

use App\Category;
use App\Store;
use App\DealsWithCode;
use App\DealWithCoupon;
use stdClass;

class DealsFilterController extends Controller
{
    public function getFilteredDeals ( $options, $page=1 )
    {
       /**
        * $options Object Json format
        *    {"category": "test", "store": "amazon", "minPrice":  10 ,"maxPrice": 10}
        */
       $options = \json_decode($options);

       $perPage = 3;
       $offset = ( ( $page - 1 ) * $perPage );
       
       $typeDeal = $options->deal ?? NULL;
       $typeCode = $options->code ?? NULL;
       $typeCoupon = $options->coupon ?? NULL;
       $categoryId = $options->category ?? NULL;
       $storeId = $options->store ?? NULL;
       $minPrice = $options->minPrice == 0 ? NULL : $options->minPrice;
       $maxPrice = $options->maxPrice == 0 ? NULL : $options->maxPrice;

        

        $deals = Deal::when($typeDeal, function ( $query, $typeDeal ) {

            return $query->orWhere('deal_type', 'deal');

        })->when($typeCode, function ($query, $typeCode) {

            return $query->orWhere('deal_type', 'code');

        })->when($typeCoupon, function ($query, $typeCoupon) {

            return $query->orWhere('deal_type', 'coupon');

        })->when($categoryId, function ($query, $categoryId) {

            return $query->where('category_id', $categoryId);

        })->when($storeId, function ($query, $storeId) {

            return $query->where('store_id', $storeId);

        })->when($minPrice, function($query, $minPrice) {

            return $query->where('new_price', '>=', $minPrice);

        })->when($maxPrice, function($query, $maxPrice) {

            return $query->where('new_price', '<=', $maxPrice);

        });

    

       $deals = $deals->with('code', 'coupon')->orderBy('id', 'DESC')->offset($offset)->limit($perPage)->get();

    
        return view('public.deals.ajax-response.deals' , [
            'deals' => $deals 
        ]);

    }

    public function filterDeals (Request $request)
    {   

        $data = [];

        $filterOption = new \stdClass();
        $filterOption->category = '';
        $filterOption->store = '';
        $filterOption->minPrice = 'any';
        $filterOption->maxPrice = 'any';

        $page = $request->input('page', 1);

        $removePrefixes = explode('/filter-deals', $request->getRequestUri() );
        $filters = explode('/', $removePrefixes[1]);

        //dd ( $filters);

        $perPage = 3;
        $offset = ( ( $page - 1 ) * $perPage );

      // dd ($filters);
        
        $deals = new Deal();

        foreach ( $filters as $index => $filter ) 
        {
            if ( $filter )
            {   
                // deal types
                if (  $filter == 'deal-type' ) 
                {
                    $dealTypes = explode ('&', $filters[$index + 1]);

                    foreach ( $dealTypes as $dealType ) {

                        $filterOption->{$dealType} = $dealType;

                        $deals =  $deals->when($dealType, function ( $query, $dealType ) {

                            return $query->orWhere('deal_type', $dealType);
                
                        });

                        // get deals with deals type, code,  coupon, or deal
                    }
                }

                // category
                if ( $filter == 'category' )
                {
                    $categorySlug = $filters[$index + 1];
                    $category = Category::where('slug', $categorySlug)->get()->first();
                    if ( $category  ) {
                        $filterOption->category = $categorySlug;
                        $categoryId = $category->id;
                        $deals = $deals->when($categoryId, function ($query, $categoryId) {
                            return $query->where('category_id', $categoryId);
                        });
                        

                        dd($deals);
                    }
                }

                // store
                if ( $filter == 'store' )
                {
                    $storeSlug = $filters[$index + 1];
                    $store = Store::where('slug', $storeSlug)->get()->first();
                    if ($store) {
                        $filterOption->store = $storeSlug;
                        $storeId = $store->id;
                        $deals = $deals->when($storeId, function ($query, $storeId) {
                           // return $query->where('store_id', $storeId);
                        });
                    }
                }

                // price
                // min price
                if ( $filter == 'min-price') 
                {
                    $minPrice =  $filters[$index + 1];

                    if ( $minPrice == 'any' ) {
                        $filterOption->minPrice = 'any';
                        $deals = $deals->when($minPrice, function($query, $minPrice) {

                           // return $query->where('new_price', '>=', 0);
                
                        });
                    } else {
                        $filterOption->minPrice = $minPrice;
                        $deals = $deals->when($minPrice, function($query, $minPrice) {

                            //return $query->where('new_price', '>=', $minPrice);
                
                        });
                    }
                }
                
                // max price
                if ( $filter == 'max-price') 
                {
                     $maxPrice =  $filters[$index + 1];

                    if ( $maxPrice == 'any' ) {

                      $filterOption->maxPrice = 'any';
                      $maxPrice = deal::max('new_price');

                        $deals = $deals->when($maxPrice, function($query, $maxPrice) {

                            //return $query->where('new_price', '<=', $maxPrice);
                
                        });
                        
                    } else 
                    {   
                        $filterOption->maxPrice = $maxPrice;
                        $deals = $deals->when($maxPrice, function($query, $maxPrice) {

                            //return $query->where('new_price', '<=', $maxPrice);
                
                        });
                    }
                }
            }
        }

        $deals = $deals->with('code', 'coupon')->orderBy('id', 'DESC')->offset($offset)->limit($perPage)->get();

        $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
        $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

        $stores = Store::all();

        $data['onlyParentCategories'] = $onlyParentCategories; 
        $data['categories'] = $categories;
        $data['stores'] = $stores;
        $data['deals'] = $deals ;
        $data['context'] = 'filter';
        $data['filterOption'] = $filterOption;
        $data['filterUrl'] = $request->getRequestUri();

        if ( $page > 1 ) {
            return view('public.deals.ajax-response.deals' , [
                'deals' =>  $data['deals']
            ]);
        } else 
        {
            //dd($filterOption);
            return view('public.deals.filter.index', $data);
        }

       


    }
}
