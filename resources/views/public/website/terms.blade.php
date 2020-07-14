@extends('public.layouts.master')

@section('page-title'){{'Shopalldeals - Deals and Coupons'}}@endsection

@section('meta-description'){{'Find best deals and coupons in the UEA - Shopalldeals'}}@endsection

@section('main-content')

    <div class="row terms deal-show">
        <div class="col-sm-12">

            {!! $terms ?? '' !!}

        </div>
    </div>
    
  

    @include('public.partials.widgets.show-footer')



@endsection


