@extends('admin.layouts.master')

@section('extra-head')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/widgets/modules-widgets.css') }}"> 
@endsection

@section('page-header')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
        
    </ol>
</nav>
@endsection

@section('main-content')
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
    <div class="widget widget-card-four">
        <div class="widget-content">
            <div class="w-content">
                <div class="w-info">
                    <h6 class="value">{{$categoriesCount}}</h6>
                    <p class="">Categories</p>
                </div>
                
            </div>
            
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
    <div class="widget widget-card-four">
        <div class="widget-content">
            <div class="w-content">
                <div class="w-info">
                    <h6 class="value">{{$storesCount}}</h6>
                    <p class="">Stores</p>
                </div>
                
            </div>
            
        </div>
    </div>
</div>
<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
    <div class="widget widget-card-four">
        <div class="widget-content">
            <div class="w-content">
                <div class="w-info">
                    <h6 class="value">{{$dealsCount}}</h6>
                    <p class="">Deals</p>
                </div>
                
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('extra-script')
<script src="{{ asset('assets/js/widgets/modules-widgets.js') }}"></script>
@endsection