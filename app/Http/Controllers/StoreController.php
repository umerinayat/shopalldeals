<?php

namespace App\Http\Controllers;

use App\Store;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStore;
use App\Http\Requests\UpdateStore;

class StoreController extends Controller
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
        $stores = Store::all();
        $data['stores'] = $stores;
        return view('admin.stores.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStore $request)
    {
        $store = Store::storeStore($request->all());
        return redirect()->action('StoreController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        $data = [];
        $data['store'] = $store;
        return view('admin.stores.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStore $request, Store $store)
    {
        $store = Store::updateStore($request->all(), $store);
        return redirect()->action('StoreController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {   
        $store->delete();
        return redirect()->action('StoreController@index');
    }
}
