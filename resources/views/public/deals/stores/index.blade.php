@extends('public.layouts.master')


@section('page-title') Shopalldeals - {{$store->name}} @endsection

@section('meta-description'){{'Find best '. $store->name . ' deals and coupons in the UEA - Shopalldeals'}}@endsection


@section('main-content')
<div class="row mb-2">
    <div class="col-sm-12">
        <span> <a href="{{route('home')}}">Deals</a> 
        /
        <a href="{{route('front.store', ['storeSlug' => $store->slug])}}">{{$store->name}}</a> 
        </span>
      </div>
</div>
    
    @include('public.partials.deals-posts')

    @include('public.partials.widgets.show-footer')

@endsection


@section('extra-script')
<script>

    var isNoMoreDeals = false;
    var context = 'index';
    var container = document.getElementById('deals-posts');
    var load_more = document.getElementById('load-more');
    var request_in_progress = false;

    function showSpinner() {
      var spinner = document.getElementById("spinner");
      spinner.style.display = 'block';
    }

    function hideSpinner() {
      var spinner = document.getElementById("spinner");
      spinner.style.display = 'none';
    }

    function showLoadMore() {
      load_more.style.display = 'inline';
    }

    function hideLoadMore() {
      load_more.style.display = 'none';
    }

    function appendToDiv(div, new_html, isReplace=false) {

      if (new_html.trim() === '0') {
          var noMoreDeals = document.createElement('div');
          noMoreDeals.style.textAlign = 'center';
          noMoreDeals.innerHTML = 'No More Deals';
          div.appendChild(noMoreDeals);
          isNoMoreDeals = true;
          hideLoadMore();
        return;
      }
      
      if (isReplace) {
          div.innerHTML = new_html;
          return;
      }
     
      // Put the new HTML into a temp div
      // This causes browser to parse it as elements.
      var temp = document.createElement('div');
      temp.innerHTML = new_html;

      // Then we can find and work with those elements.
      var class_name = temp.firstElementChild.className;
      var items = temp.getElementsByClassName(class_name);

       var len = items.length;
      for(i=0; i < len; i++) {
        div.appendChild(items[0]);
      }
    }

    function setCurrentPage(page) {
      console.log('Incrementing page to: ' + page);
      load_more.setAttribute('data-page', page);
    }

    function scrollReaction() {
      var content_height = container.offsetHeight;
      var current_y = window.innerHeight + window.pageYOffset;
      // console.log(current_y + '/' + content_height);
      if(current_y >= content_height) {
        loadMore(context);
      }
    }

  function loadMore() {

    if ( isNoMoreDeals ) {
        return;
      }

      if(request_in_progress) { return; }
      request_in_progress = true;

      showSpinner();
      hideLoadMore();

      var page = parseInt(load_more.getAttribute('data-page'));
      var next_page = page + 1;

    
      if (context == 'filter') {
          var url = '/getFilteredDeals/' + JSON.stringify(filterOptions) + '/' + next_page;
      } else if (context == 'search') {
        var url = '';
      } else {
        var url = '/stores/' + next_page + '/' + '{{$store->slug}}';
      }

      

      var xhr = new XMLHttpRequest();
      xhr.open('GET', url, true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onreadystatechange = function () {
        if(xhr.readyState == 4 && xhr.status == 200) {
          var result = xhr.responseText;
          console.log('Result: ' + result);

          hideSpinner();
          setCurrentPage(next_page);
          // append results to end of deals posts
          showLoadMore();
          appendToDiv(container, result);
          
          request_in_progress = false;
        }
      };
      xhr.send();
    }

    load_more.addEventListener("click", loadMore);

    window.onscroll = function() {
      scrollReaction();
    }

    // Load even the first page with Ajax
    //loadMore();

    
   // handling filter deals
   $typeDeal = $('#typeDeal');
    $typeCode = $('#typeCode');
    $typeCoupon = $('#typeCoupon');

    var filterOptions = {};
    $categoryFilter = $('#categoryFilter');
    $storeFilter = $('#storeFilter');
    $minPrice = $('#minPrice');
    $maxPrice = $('#maxPrice');

    


    $applyFilterBtn = $('#applyFilterBtn');

    $applyFilterBtn.on('click', function (evt) {
        $('#filterContainer').toggle();
        filterOptions = {};
        load_more.setAttribute('data-page', 1);
        
        $categoryFilter.val() != 'none' ? filterOptions.category = $categoryFilter.val() : '';
        $storeFilter.val() != 'none' ? filterOptions.store = $storeFilter.val() : '';
        isNoMoreDeals = false;
     
        filterOptions.minPrice = $minPrice.val();
        filterOptions.maxPrice = $maxPrice.val();
        

        if ($typeDeal.is(":checked")) {
            filterOptions.deal = 1;
        }

        if ($typeCode.is(":checked")) {
            filterOptions.code = 1;
        }

        if ($typeCoupon.is(":checked")) {
            filterOptions.coupon = 1;
        }

    

        $.ajax({url: '/getFilteredDeals/'+JSON.stringify(filterOptions), success: function(result){
            console.log(result);
            context = 'filter';
             
            appendToDiv(container, result, true);
        }});
    }); 
    


  </script>
@endsection

