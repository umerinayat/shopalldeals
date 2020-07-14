@extends('admin.layouts.master')


@section('page-title')
    Update store
@endsection


@section('page-header')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Stores</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Edit</span></li>
    </ol>
</nav>
@endsection

@section('main-content')
<div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-10 col-md-6 col-sm-6 col-6">
                        <h4>Update Store</h4>
                    </div>   
                    <div class="col-xl-2 col-md-6 col-sm-6 col-6 text-right mt-3">
                    <a href="{{route('stores.index')}}" class="btn mr-2 btn-outline-primary btn-rounded mb-2">View All</a>
                    </div>                                                                          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('stores.update', ['store' => $store]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('admin.stores.fields')
                                     
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </div>
                    </div>
                </form>

        </div>
    </div>
</div>
@endsection