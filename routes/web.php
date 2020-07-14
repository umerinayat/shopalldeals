<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// Admin routes
Auth::routes();
Route::prefix('admin')->group(function () {

    Route::get('/', 'AdminController@index');
    Route::get('dashbarod', 'AdminController@index');

    Route::get('/deals/simple', 'DealController@getSimpleDeals')->name('simpleDeals');
    Route::get('/deals/code', 'DealController@getCodeDeals')->name('codeDeals');
    Route::get('/deals/coupon', 'DealController@getCouponDeals')->name('couponDeals');
   
  

    Route::post('/allDeals', 'DealController@allDeals')->name('allDeals');
    Route::post('/allCodeDeals', 'DealController@allCodeDeals')->name('allCodeDeals');
    Route::post('/allCouponsDeals', 'DealController@allCouponsDeals')->name('allCouponsDeals');
    Route::post('/all', 'DealController@all')->name('all');

    // CATEGORIES SECTION 
    // ajax calls
    Route::get('/categories/getSubCategories/{category}', 'CategoryController@getSubCategories');
    Route::get('/categories/getChildCategories/{sub_category}', 'CategoryController@getChildCategories');

    Route::post('/websites_settings/update-website-settings', 'WebsiteSettingsController@storeWebsiteSettings')->name('storeWebisteSettings');
    Route::get('/websites_settings/update-website-settings/{id?}', 'WebsiteSettingsController@edit')->name('website_settings.edit');
  

    Route::resource('categories', 'CategoryController');
    Route::resource('sub_categories', 'SubCategoriesController');
    Route::resource('child_categories', 'ChildCategoriesController');
    Route::resource('stores', 'StoreController');
    Route::resource('deals', 'DealController');
    

});



// public routes




// Home page
Route::get('/', 'Front\IndexController@index')->name('home');
// load more deals


Route::get('/terms-and-conditions', 'Front\WebsiteController@terms')->name('terms');
Route::get('/privacy-policy', 'Front\WebsiteController@privacyPolicy')->name('privacy');
Route::get('/about-us', 'Front\WebsiteController@aboutUs')->name('about');




Route::get('/alldeals/{page}','Front\DealsCatalogController@loadMoreDeals')->name('front.loadMoreDeals');
// show deals details
Route::get('/deals/{slug}', 'Front\DealsCatalogController@dealDetails')->name('dealDetails');


// Categories section
Route::get('/category/{catSlug?}/{subCatSlug?}/{childCatSlug?}','Front\DealsCatalogController@category')->name('front.category');
// Load more categories deals ajax call
Route::get('/categories/{page}/{catSlug?}/{subCatSlug?}/{childCatSlug?}','Front\DealsCatalogController@loadMoreCategoryDeals')->name('front.loadMoreCategoryDeals');


// Stores section
Route::get('/store/{storeSlug}','Front\DealsCatalogController@store')->name('front.store');
// load more store deals
Route::get('/stores/{page}/{storeSlug}','Front\DealsCatalogController@loadMoreStoreDeals')->name('front.loadMoreStoreDeals');


// Deals filter
Route::get('/getFilteredDeals/{options}/{page?}', 'Front\DealsFilterController@getFilteredDeals');
Route::get('/filter-deals/{dealType?}/{dealTypeValue?}/{category?}/{categoryValue?}/{store?}/{storeValue?}/{minPrice?}/{minPriceValue?}/{maxPrice?}/{maxPriceValue?}', 'Front\DealsFilterController@filterDeals')->name("filterDeals");

// Deals Search
Route::get('/getSearchSuggestions/{q}', 'Front\DealsSearchController@getSearchSuggestions')->name('getSearchSuggestions');
Route::get('/search-deals/{page?}/{q?}/{isAjx?}', 'Front\DealsSearchController@searchDeals')->name('searchDeals');








