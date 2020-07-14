<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!--  fonts -->
  <link href="{{asset('front-end-assets/css/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <!-- <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'> -->
    
    
    <link rel="stylesheet" href="{{ asset('front-end-assets/css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <title>@yield('page-title')</title>
    <meta name="description" content="@yield('meta-description')">

    @yield('extra-head')

    <style>

      #spinner {
          display: none;
      }

     
    </style>

  </head>
  <body>
        
    <!-- Site Navigation -->
    @include('public.partials.site-navigation')
    <!-- /Site Navigation -->

    @if (Route::current()->getName() !== 'dealDetails' && Route::current()->getName() !== 'terms' && Route::current()->getName() !== 'privacy' && Route::current()->getName() !== 'about' )
      <!-- Site banner -->
      @include('public.partials.site-banner') 
      <!-- /Site banner -->

      <!-- Filter Deals -->
      @include('public.partials.widgets.filter-deals') 
      <!-- /Filter Deals -->
    @endif

    <main>
        <div class="container mt-3 main-content">
          @yield('main-content')
        </div>
    </main>

    <!-- site footer -->
    @include('public.partials.site-footer')

 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{asset('front-end-assets/js/custom-app.js')}}"></script>
      @yield('extra-script')

    <script> 
  
      
      document.addEventListener('DOMContentLoaded', function() {

      var suggestions = document.getElementById("suggestions");
      var form = document.getElementById("search-form");
      var search = document.getElementById("search");

      function suggestionsToList(items) {
   
        var output = '';

     
      for(i=0; i < items.length; i++) {
        output += '<li>';
        output += '<a href="/deals/' + items[i].slug +'">';
        output += items[i].title;
        output += '</a>';
        output += '</li>';
      }

     return output;
  }

  function showSuggestions(json) {
    var li_list = suggestionsToList(json.suggestions);
    suggestions.innerHTML = li_list;
    suggestions.style.display = 'block';
  }

  function getSuggestions() {
    var q = search.value;

    if(q.length < 3) {
      suggestions.style.display = 'none';
      return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/getSearchSuggestions/' + q, true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.onreadystatechange = function () {
      if(xhr.readyState == 4 && xhr.status == 200) {
        var result = xhr.responseText;
        console.log('Result: ' + result);

        var json = JSON.parse(result);
        showSuggestions(json);
      }
    };
    xhr.send();
  }

  search.addEventListener("input", getSuggestions);

  });

  
    </script>


  </body>
</html>