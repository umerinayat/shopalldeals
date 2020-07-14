<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Store;
use App\WebsiteSetting;

class WebsiteController extends Controller
{
    
    public function terms ()
    {
        $data = [];

        $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
        $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

        $stores = Store::all();

        $data['onlyParentCategories'] = $onlyParentCategories; 
        $data['categories'] = $categories;
        $data['stores'] = $stores;

        $websiteSettings = WebsiteSetting::get();

        if ( count($websiteSettings) > 0 ) 
        {
            $data['terms'] = $websiteSettings[0]->termsnc_text;
        }

        return view ('public.website.terms', $data);
    }

    public function privacyPolicy ()
    {
        $data = [];

        $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
        $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

        $stores = Store::all();

        $data['onlyParentCategories'] = $onlyParentCategories; 
        $data['categories'] = $categories;
        $data['stores'] = $stores;

        $websiteSettings = WebsiteSetting::get();

        if ( count($websiteSettings) > 0 ) 
        {
            $data['privacyPolicy'] = $websiteSettings[0]->privacy_policy_text;
        }

        return view ('public.website.privacy-policy', $data);
    }

    // about us
    public function aboutUs ()
    {
        $data = [];

        $categories = Category::has('subs')->orderBy('order', 'ASC')->get();
        $onlyParentCategories = Category::has('subs', '<=', 0)->orderBy('order', 'ASC')->get();

        $stores = Store::all();

        $data['onlyParentCategories'] = $onlyParentCategories; 
        $data['categories'] = $categories;
        $data['stores'] = $stores;

        $websiteSettings = WebsiteSetting::get();

        if ( count($websiteSettings) > 0 ) 
        {
            $data['aboutUs'] = $websiteSettings[0]->about_us;
        }

        return view ('public.website.about-us', $data);
    }

}
