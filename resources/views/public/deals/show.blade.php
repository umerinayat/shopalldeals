@extends('public.layouts.master')


@section('page-title'){{$deal->title}}@endsection

@section('meta-description'){{$deal->meta_description}}@endsection

@section('extra-head')
    <link rel="stylesheet" href="{{ asset('front-end-assets/css/showdeal.css') }}">
@endsection

@section('main-content')

<div class="row mb-2 deal-show">
    <div class="col-sm-9">
        <span class="text-muted"> 
          <a href="/">Deals</a> 
          / 
          <a href="{{ route('front.category', ['catSlug' => $deal->category->slug]) }}">{{$deal->category->name}}</a> 
          @if(isset($deal->subcategory))
           / 
           <a href="{{ route('front.category', ['catSlug' => $deal->category->slug, 'subCatSlug' => $deal->subcategory->slug]) }}">{{$deal->subcategory->name}}</a> 
          @endif
          @if(isset($deal->childcategory))
           / 
           <a href="{{ route('front.category', ['catSlug' => $deal->category->slug, 'subCatSlug' => $deal->subcategory->slug, 'childCatSlug' => $deal->childcategory->slug]) }}">{{$deal->childcategory->name}}</a> 
          @endif
        </span>
    </div>
</div>

<div class="card mb-2 deal-card p-2">
          <!--header -->
        <div class="text-right deal-header">
            <strong class="deal-type"> {{ $deal->deal_type == 'code' ? 'Deal with ' : '' }} {{ucfirst($deal->deal_type)  }} <span class="deal-expire">{{$deal->is_expired ? 'Expired' : ''}}</span></strong> <span class="deal-date">{{ $deal->created_at->diffForHumans() }}</span>
        </div>
        <!-- /header -->

        <div class="deal-box">
            <div class="deal-img-con">
                <img class="deal-img" src="/images/{{$deal->image}}" alt="{{$deal->image}}">
            </div>
            <div class="deal-detail-con">
               <div class="deal-title"> 
                    <strong>{{$deal->title}}</strong>
               </div>
               
               <div class="deal-actions">
                   <ul>
                    @if($deal->deal_type == 'deal' || $deal->deal_type == 'code')
                       <li class="deal-price">AED {{$deal->new_price}}</li>
                       @if($deal->is_free_shipping)
                            <li class="free-shipping">
                                <small><em class="text-muted"> + free shipping</em></small>
                            </li>
                        @endif
                       <li class="deal-old-price"><strike>AED {{$deal->old_price}}</strike></li>
                       <li class="deal-discount">{{$deal->discount}}</li>
                    @endif
                    @if($deal->deal_type == 'coupon')
                        <li class="deal-savings"><strong> {{$deal->coupon->savings}}</strong></li>
                        @if($deal->is_free_shipping)
                            <li class="free-shipping">
                                <small><em class="text-muted"> + free shipping</em></small>
                            </li>
                        @endif
                    @endif
                       <li class="store-separator"></li>
                       <li class="deal-store">{{$deal->store->name}}</li>
                   </ul>
               </div>
               <div class="buy-now">
               @if($deal->deal_type == 'deal' || $deal->deal_type == 'code')
                        <a href="{{$deal->link_to_deal}}" target="_blank" class="btn btn-sm mr-4 btn-success">BUY NOW</a>
                        @if($deal->deal_type == 'code')
                        <div onclick="window.hanldeCopyCode(event)" data-code='{{$deal->code->copy_code}}'  class="mt-2 copy-code-con text-center">
                            <div class="copy-code-trigger">
                                <i  class="fas fa-cut copy-cut"></i>
                                <span class="copy-code-label">COPY CODE</span>
                            </div>
                            <div class="copy-code-status">
                                
                            </div>
                        </div>
                        @endif
                    @endif
                    @if($deal->deal_type == 'coupon')
                    <a href="{{$deal->link_to_deal}}" target="_blank" class="btn btn-sm mr-4 btn-success">USE COUPON</a>
                    <div onclick="window.hanldeCouponCode(event)" data-code='{{$deal->coupon->coupon_code}}'  class="mt-2 coupon-con">

                    <div class="coupon-code-trigger">
                        <i  class="fas fa-cut copy-cut"></i>
                        <span class="copy-coupon-label">COPY COUPON</span>
                    </div>


                    </div>
                    @endif
                </div>

              
               
               <div class="deal-description">
                    <p class="text-muted short-description m-0 mb-1">{!! $deal->description !!}</p>
               </div>
               
            </div>
        </div>
        <div style="clear: both"></div>
        <div class="buy-now-sm-con">
                @if($deal->deal_type == 'deal' || $deal->deal_type == 'code')
                    <a href="{{$deal->link_to_deal}}" target="_blank" class="btn  btn-sm mr-3 btn-success">BUY NOW</a>
                    @if($deal->deal_type == 'code')
                    <div onclick="window.hanldeCopyCode(event)" data-code='{{$deal->code->copy_code}}'  class="mt-2 copy-code-con text-center">
                        <div class="copy-code-trigger">
                            <i  class="fas fa-cut copy-cut"></i>
                            <span class="copy-code-label">COPY CODE</span>
                        </div>
                        <div class="copy-code-status">
                            
                        </div>
                    </div>
                    @endif
                @endif
                   @if($deal->deal_type == 'coupon')
                    <a href="{{$deal->link_to_deal}}" target="_blank" class="btn btn-sm mr-4 btn-success">USE COUPON</a>
                    <div onclick="window.hanldeCouponCode(event)" data-code='{{$deal->coupon->coupon_code}}'  class="mt-2 coupon-con">

                    <div class="coupon-code-trigger">
                        <i  class="fas fa-cut copy-cut"></i>
                        <span class="copy-coupon-label">COPY COUPON</span>
                    </div>


                    </div>
                @endif
            </div>
        
    </div>


@endsection


@section('extra-script')
<script>


 </script>
@endsection
