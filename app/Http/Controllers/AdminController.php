<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Store;
use App\Deal;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        return view('admin.index' , [
            'categoriesCount' => Category::count(),
            'storesCount' => Store::count(),
            'dealsCount' =>  Deal::count(),
        ]);
    }
}
