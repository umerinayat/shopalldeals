@extends('admin.layouts.master')


@section('page-title')
    add new category
@endsection


@section('page-header')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Categories</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Add New</span></li>
    </ol>
</nav>
@endsection

@section('main-content')
<div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-10 col-md-6 col-sm-6 col-6">
                        <h4>Add New Category</h4>
                    </div>   
                    <div class="col-xl-2 col-md-6 col-sm-6 col-6 text-right mt-3">
                    <a href="{{route('categories.index')}}" class="btn mr-2 btn-outline-primary btn-rounded mb-2">View All</a>
                    </div>                                                                          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf

                    @include('admin.categories.fields')
                                     
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mt-3">Add</button>
                        </div>
                    </div>
                </form>


        </div>
    </div>
</div>
@endsection