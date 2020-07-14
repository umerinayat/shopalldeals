<?php

namespace App\Http\Controllers;

use App\Category;
use App\Store;
use App\Deal;
use App\DealsWithCode;
use App\DealWithCoupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DealController extends Controller
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

        // $deals = Deal::orderBy('id', 'DESC')->get();

        // $data['deals'] = $deals;

        return view('admin.deals.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        return view('admin.deals.create', [
            'categories' => Category::get(),
            'stores' => Store::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\StoreDeal $request)
    {   

        $dealType = $request['deal_type'];
    
        $request['meta_title'] = Str::limit($request->title, 55);
        $request['meta_description'] = Str::limit(\strip_tags($request->short_description), 155);
        
        if ($dealType == 'code')
        {     
            $this->validate($request,[
                'copy_code' => 'required',
                'old_price' => 'required',
                'new_price' => 'required',
                'discount' => 'required',
            ]);
        } 
        else if ($dealType == 'coupon') 
        {
            $this->validate($request,[
                'coupon' => 'required',
                'savings' => 'required'
            ]);
        } 
        else if ($dealType == 'deal') 
        {
            $this->validate($request,[
                'old_price' => 'required',
                'new_price' => 'required',
                'discount' => 'required',
            ]);
        }

        $request['is_free_shipping'] = $request->input('is_free_shipping', 0) === 'on' ? 1 : 0;
        $request['is_expired'] = $request->input('is_expired', 0) === 'on' ? 1 : 0;
        $newDeal = Deal::storeDeal($request);

        
        return redirect()->action('DealController@show', ['deal' => $newDeal]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function show(Deal $deal)
    {
       
        if ($deal->deal_type == 'deal') 
        {
        } 
        else if ($deal->deal_type == 'code')
        {
            $deal->code = DealsWithCode::where('deal_id', $deal->id)->get()->first();
        }
        else if ($deal->deal_type == 'coupon')
        {
            $deal->coupon = DealWithCoupon::where('deal_id', $deal->id)->get()->first();
        }

        return view('admin.deals.show', ['deal' => $deal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function edit(Deal $deal)
    {

        if ($deal->deal_type == 'deal') 
        {
        } 
        else if ($deal->deal_type == 'code')
        {
            $deal->codeDeal = DealsWithCode::where('deal_id', $deal->id)->get()->first();
        }
        else if ($deal->deal_type == 'coupon')
        {
            $deal->couponDeal = DealWithCoupon::where('deal_id', $deal->id)->get()->first();
        }


        return view('admin.deals.edit', [
            'categories' => Category::get(),
            'stores' => Store::get(),
            'deal' => $deal
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function update(\App\Http\Requests\UpdateDeal $request, Deal $deal)
    {
    $dealType = $request['deal_type'];

    // SEO
     
     $request['meta_title'] = Str::limit($request->title, 55);
     $request['meta_description'] = Str::limit(\strip_tags($request->short_description), 155);



        if ($dealType == 'code')
        {     
            $this->validate($request,[
                'copy_code' => 'required',
                'old_price' => 'required',
                'new_price' => 'required',
                'discount' => 'required',
            ]);
        } 
        else if ($dealType == 'coupon') 
        {
            $this->validate($request,[
                'coupon' => 'required',
                'savings' => 'required'
            ]);
        } 
        else if ($dealType == 'deal') 
        {
            $this->validate($request,[
                'old_price' => 'required',
                'new_price' => 'required',
                'discount' => 'required',
            ]);
        }
        
        $request['is_free_shipping'] = $request->input('is_free_shipping', 0) === 'on' ? 1 : 0;
        $request['is_expired'] = $request->input('is_expired', 0) === 'on' ? 1 : 0;
        $updatedDeal = Deal::updateDeal($deal, $request);

        

        return redirect()->action('DealController@show', ['deal' => $deal]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deal  $deal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
        $deal->delete();
        return redirect()->action('DealController@index');
    }

    // get deals of type deal
    public  function getSimpleDeals()
    {
        $data = [];
        return view('admin.deals.simple-deals.index', $data);
    }

    // get deals of type code
    public function getCodeDeals()
    {
        $data = [];
        return view('admin.deals.code-deals.index', $data);
    }

    // get deals of type coupon
    public function getCouponDeals()
    {
        $data = [];
        return view('admin.deals.coupon-deals.index', $data);
    }



    //--
     // ajax call to get all deals of type deal for datatables
     public function all ( Request $request)
     {
         $columns = [ 
             0 =>'id', 
             1 =>'title',
             2 => 'category',
             3 => 'store',
             4 => 'deal_type',
             5 => 'id',
         ];
   
         $totalData = Deal::count();
             
         $totalFiltered = $totalData; 
 
         $limit = $request->input('length');
         $start = $request->input('start');
         $order = $columns[$request->input('order.0.column')];
         if (!$order) {
            $order = 'id';
         }
          $dir = $request->input('order.0.dir');
          if(!$dir) {
            $dir = 'asc';
          }

        //  dd($request->input('_token'));
             
         if(empty($request->input('search.value')))
         {            
            try {
                $posts = Deal::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
         }
         else {
             $search = $request->input('search.value'); 
 
             $posts =  Deal::where('title', 'LIKE',"%{$search}%")
                             ->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
 
             $totalFiltered = Deal::where('title', 'LIKE',"%{$search}%")
                              ->count();
         }
 
         $data = array();
         if(!empty($posts))
         {
             foreach ($posts as $post)
             {
                 $show =  route('deals.show',$post->id);
                 $edit =  route('deals.edit',$post->id);
 
                 $nestedData['id'] = $post->id;
                 $nestedData['title'] = $post->title;
                 $nestedData['deal_type'] = $post->deal_type;
                 $nestedData['category'] = $post->category->name;
                 $nestedData['store'] = $post->store->name;
                 $nestedData['options'] = "<div style='text-align:center'><a href='{$show}'>View</a>
                                           &emsp;<a href='{$edit}'>Edit</a></div>";
                 $data[] = $nestedData;
 
             }
         }
           
         $json_data = array(
                     "draw"            => intval($request->input('draw')),  
                     "recordsTotal"    => intval($totalData),  
                     "recordsFiltered" => intval($totalFiltered), 
                     "data"            => $data   
                     );
             
         echo json_encode($json_data); 
     }
    //--
    // ajax call to get all deals of type deal for datatables
    public function allDeals ( Request $request)
    {
        $columns = [ 
            0 =>'id', 
            1 =>'title',
            2 => 'old_price',
            3 => 'new_price',
            4 => 'category',
            5 => 'store',
            6 => 'id',
        ];
  
        $totalData = Deal::where('deal_type', 'deal')->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $posts = Deal::where('deal_type', 'deal')->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $posts =  Deal::where('deal_type', 'deal')
                            ->where('title', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Deal::where('deal_type', 'deal')
                             ->where('title', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {
                $show =  route('deals.show',$post->id);
                $edit =  route('deals.edit',$post->id);

                $nestedData['id'] = $post->id;
                $nestedData['title'] = $post->title;
                $nestedData['old_price'] = $post->old_price;
                $nestedData['new_price'] = $post->new_price;
                $nestedData['category'] = $post->category->name;
                $nestedData['store'] = $post->store->name;
                $nestedData['options'] = "<div style='text-align:center'><a href='{$show}'>View</a>
                                          &emsp;<a href='{$edit}'>Edit</a></div>";
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }
     // ajax call to get all code deals for datatables
     public function allCodeDeals ( Request $request)
     {
         $columns = [ 
             0 =>'id', 
             1 =>'title',
             2 => 'old_price',
             3 => 'new_price',
             4 => 'id', // code column filter by id
             5 => 'category',
             6 => 'store',
             7 => 'id', // actions column filter by id
         ];
   
         $totalData = Deal::where('deal_type', 'code')->count();
             
         $totalFiltered = $totalData; 
 
         $limit = $request->input('length');
         $start = $request->input('start');
         $order = $columns[$request->input('order.0.column')];
         $dir = $request->input('order.0.dir');
             
         if(empty($request->input('search.value')))
         {            
             $posts = Deal::where('deal_type', 'code')->offset($start)
                          ->limit($limit)
                          ->orderBy($order,$dir)
                          ->get();
         }
         else {
             $search = $request->input('search.value'); 
 
             $posts =  Deal::where('deal_type', 'code')
                             ->where('title', 'LIKE',"%{$search}%")
                             ->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
 
             $totalFiltered = Deal::where('deal_type', 'code')
                              ->where('title', 'LIKE',"%{$search}%")
                              ->count();
            
         }
 
         $data = array();
         if(!empty($posts))
         {
             foreach ($posts as $post)
             {
                 $show =  route('deals.show',$post->id);
                 $edit =  route('deals.edit',$post->id);
 
                 $nestedData['id'] = $post->id;
                 $nestedData['title'] = $post->title;
                 $nestedData['old_price'] = $post->old_price;
                 $nestedData['new_price'] = $post->new_price;
                 $nestedData['code'] = (DealsWithCode::where('deal_id', $post->id)->get()->first())->copy_code;
                 $nestedData['category'] = $post->category->name;
                 $nestedData['store'] = $post->store->name;
                 $nestedData['options'] = "<div style='text-align:center'><a href='{$show}'>View</a>
                                           &emsp;<a href='{$edit}'>Edit</a></div>";
                 $data[] = $nestedData;
 
             }
         }
           
         $json_data = array(
                     "draw"            => intval($request->input('draw')),  
                     "recordsTotal"    => intval($totalData),  
                     "recordsFiltered" => intval($totalFiltered), 
                     "data"            => $data   
                     );
             
         echo json_encode($json_data); 
     }
    // ajax call to get all code deals for datatables
     public function allCouponsDeals ( Request $request )
     {
         $columns = [ 
             0 =>'id', 
             1 =>'title',
             2 => 'id', // filter by id => coupon_code
             3 => 'id', // filter by id => savings
             4 => 'category',
             5 => 'store',
             6 => 'id', // actions column filter by id
         ];
   
         $totalData = Deal::where('deal_type', 'coupon')->count();
             
         $totalFiltered = $totalData; 
 
         $limit = $request->input('length');
         $start = $request->input('start');
         $order = $columns[$request->input('order.0.column')];
         $dir = $request->input('order.0.dir');
             
         if(empty($request->input('search.value')))
         {            
             $posts = Deal::where('deal_type', 'coupon')->offset($start)
                          ->limit($limit)
                          ->orderBy($order,$dir)
                          ->get();
         }
         else {
             $search = $request->input('search.value'); 
 
             $posts =  Deal::where('deal_type', 'coupon')
                             ->where('title', 'LIKE',"%{$search}%")
                             ->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->get();
 
             $totalFiltered = Deal::where('deal_type', 'coupon')
                              ->where('title', 'LIKE',"%{$search}%")
                              ->count();
            
         }
 
         $data = array();
         if(!empty($posts))
         {
             foreach ($posts as $post)
             {
                 $show =  route('deals.show',$post->id);
                 $edit =  route('deals.edit',$post->id);
 
                 $nestedData['id'] = $post->id;
                 $nestedData['title'] = $post->title;
                 $nestedData['old_price'] = $post->old_price;
                 $nestedData['new_price'] = $post->new_price;
                 $coupon = DealWithCoupon::where('deal_id', $post->id)->get()->first();
                 $nestedData['coupon'] = $coupon->coupon_code;
                 $nestedData['savings'] = $coupon->savings;
                 $nestedData['category'] = $post->category->name;
                 $nestedData['store'] = $post->store->name;
                 $nestedData['options'] = "<div style='text-align:center'><a href='{$show}'>View</a>
                                           &emsp;<a href='{$edit}'>Edit</a></div>";
                 $data[] = $nestedData;
 
             }
         }
           
         $json_data = array(
                     "draw"            => intval($request->input('draw')),  
                     "recordsTotal"    => intval($totalData),  
                     "recordsFiltered" => intval($totalFiltered), 
                     "data"            => $data   
                     );
             
         echo json_encode($json_data); 
     }
}
