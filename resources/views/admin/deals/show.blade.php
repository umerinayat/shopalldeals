@extends('admin.layouts.master')

@section('page-title')
    view deal
@endsection

@section('extra-head')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/components/cards/card.css') }}">
@endsection

@section('page-header')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Deals</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>View</span></li>
    </ol>
</nav>
@endsection

@section('main-content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
<div class="card component-card_4" style="width:100%">
            <div class="card-header bg-white">
                <div class="row">
                    <div class="col-sm-4 text-right offset-sm-8">
                        <a href="{{ route('deals.edit', ['deal' => $deal]) }}" class="btn mr-2 btn-outline-primary btn-rounded ">Edit</a>
                        
                        <form style="display:inline" method="POST" action="{{ route('deals.destroy', ['deal' => $deal]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn mr-2 btn-outline-danger btn-rounded ">Delete</button>                            
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="user-profile">
                    <img src="/images/{{$deal->image}}" style="border-radius:0;max-width:220px;max-height:220px" alt="{{$deal->image}}">
                </div>
                <div class="user-info">
                    <h5 class="card-user_name">{{$deal->title}}</h5>
                    
                    <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        @if($deal->deal_type == 'deal' || $deal->deal_type == 'code')
                                            <th><div class="th-content">New Price</div></th>
                                            <th><div class="th-content">Old Price</div></th>
                                        @endif
                                        @if($deal->deal_type == 'code')
                                            <th><div class="th-content">Code</div></th>
                                        @endif
                                        @if($deal->deal_type == 'coupon')
                                            <th><div class="th-content">Coupon Code</div></th>
                                            <th><div class="th-content">Savings</div></th>
                                        @endif

                                        <th><div class="th-content">Category</div></th>
                                        @if(isset($deal->subcategory))
                                        <th><div class="th-content">Sub Category</div></th>
                                        @endif
                                        @if(isset($deal->childcategory))
                                        <th><div class="th-content">Child Category</div></th>
                                        @endif
                                        <th><div class="th-content">Store</div></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if($deal->deal_type == 'deal' || $deal->deal_type == 'code')
                                            <td><div class="td-content">{{ $deal->new_price }}</div></td>
                                            <td><div class="td-content">{{ $deal->old_price }}</div></td>
                                        @endif
                                        @if($deal->deal_type == 'code')
                                            <td><div class="td-content">{{ $deal->code->copy_code }}</div></td>
                                        @endif
                                        @if($deal->deal_type == 'coupon')
                                            <td><div class="td-content">{{ $deal->coupon->coupon_code }}</div></td>
                                            <td><div class="td-content">{{ $deal->coupon->savings }}</div></td>
                                        @endif

                                        <td><div class="td-content">{{ $deal->category->name }}</div></td>
                                        @if(isset($deal->subcategory))
                                            <td><div class="td-content">{{ $deal->subcategory->name }}</div></td>
                                        @endif
                                        @if(isset($deal->childcategory))
                                            <td><div class="td-content">{{ $deal->childcategory->name }}</div></td>
                                        @endif
                                        <td><div class="td-content">{{ $deal->store->name }}</div></td>

                                    </tr>
                            
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <div class="card-footer" style="background:#fff;color:#000">
                  <h5>Description</h5>
                    <p class="card-text"> {!! $deal->description !!} </p>
            </div>
        </div>            
</div>

@endsection

@section('extra-script')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    
    
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection