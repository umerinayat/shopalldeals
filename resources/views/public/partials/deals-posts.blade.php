<div id="deals-posts">
@foreach($deals as $deal)
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
                    <p class="text-muted short-description m-0 mb-1">{!! substr($deal->short_description, 0, 100) !!}</p>
               </div>
               <div class="show-more">
                    <b><a class="show-more"  href="{{ route('dealDetails', ['slug' => $deal->slug]) }}">Show more</a></b>
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
@endforeach
</div>



<div class="row text-center mt-4 mb-4">
        <div class="col-sm-12">
            <div id="spinner">
                <img src="/images/spinner.gif" width="50" height="50" />
            </div>
        </div>
</div>

<div class="row text-center mb-4 mt-4">
    <div class="col-sm-12">
        <div id="load-more-container">
            <button style="z-index:1000;" id="load-more" class="btn btn-info" data-page="1">Load more</button>
        </div>
    </div>
</div>



