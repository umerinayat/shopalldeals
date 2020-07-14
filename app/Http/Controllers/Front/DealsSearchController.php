<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\Deal;
use App\DealsWithCode;
use App\DealWithCoupon;

class DealsSearchController extends Controller
{
    public function getSearchSuggestions ( $query )
    {
        if(!$this->is_ajax_request()) {
            exit;
        }

        $max_suggestions = 8;

        $suggestions = Deal::Where('title', 'LIKE', "%$query%")
                            ->limit($max_suggestions)
                            ->orderBy('id', 'DESC')->get();

        return ['success' => true, 'suggestions' => $suggestions];

    }

    public function searchDeals ($page=1, $q='', $isAjx='no', Request $request)
    {
        $data = [];

        if ($isAjx==='no') {
            $q = $request->input('q', $q);
        } 
       
        $perPage = 3;
        $offset = ( ( $page - 1 ) * $perPage );
        
        $deals = Deal::Where('title', 'LIKE', "%$q%")->with('code', 'coupon')->orderBy('id', 'DESC')->offset($offset)->limit($perPage)->get();

      
        
        if ($isAjx === 'yes') 
        {
            
            return view('public.deals.ajax-response.deals' , [
                'deals' => $deals
            ]);
        } 
        else 
        {
            $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
            $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

           
            $data['deals'] = $deals;
            $data['categories'] = $categories;
            $data['onlyParentCategories'] = $onlyParentCategories; 
            $data['stores'] = Store::all();
            $data['context'] = 'search';
            $data['q'] = $q;
            

          
           
            return view('public.index', $data);
        }

      


    }

    function is_ajax_request() {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
          $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
      }
    
      
}
