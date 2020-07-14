<!--- Navigation -->
<nav class="navbar navbar-expand-lg shadow-lg">
<div class="container-fluid">


        <a href="/" class="navbar-brand text-white text-left">
            <img class="logo" src="{{asset('images/logo.png')}}" alt="shopalldeals">
        </a>
            
            
        <span class="nav-trigger">
                <li class="fas fa-bars"></li>
        </span>
        @include('public.partials.widgets.mobile-nav')
      

    <div class=" navbar-collapse">
        <ul id="left-nav" class="navbar-nav ml-4">
            <!-- categories -->
            <li class="nav-item" id="c-container">
                <a id="categoriesTrigger" href="{{route('home')}}" class="nav-link mr-3">Categories</a>
                
                    <ul id="c-list" class="shadow bg-white c-list-hide">
                        @foreach($categories as $cat)
                        <li class="p-container"  data-target="{{$cat->slug}}">
                            <a href="{{route('front.category', ['catSlug' => $cat->slug])}}" class="custom-link">{{$cat->name}} </a>
                            
                            @if(count($cat->subs) > 0)
                            <div class="p-body shadow bg-white" id="{{$cat->slug}}">
                               
                               

                                    @foreach($cat->subs as $subCat)
                                    <div class="custom-col">
                                        
                                            <b> <a href="{{route('front.category', ['catSlug' => $cat->slug, 'subCatSlug' => $subCat->slug])}}" class="custom-link">{{$subCat->name}} </a></b>
                                       
                                        @if(count($subCat->childs) > 0)
                                        <ul class="nested-list clear-fix">
                                        @foreach($subCat->childs as $childCat) 
                                            <li>
                                                <a href="{{route('front.category', ['catSlug' => $cat->slug, 'subCatSlug' => $subCat->slug, 'childCatSlug' => $childCat->slug,])}}" class="custom-link"> {{$childCat->name}} </a>
                                            </li>
                                        @endforeach
                                           
                                        </ul>
                                        @endif
                                    </div>
                                    @endforeach
                                
                                
                                
                            </div>
                            <div class="clear-fix"></div>
                            @endif
                        </li>
                        @endforeach
                       
                        <li class="m-2 p-0" style="cursor:unset;background:rgb(236, 236, 236);height:1px"></li>

                        <!-- top level parent categories -->
                        @foreach($onlyParentCategories as $pCat)
                        <li>
                        
                            <a href="{{route('front.category', ['catSlug' => $pCat->slug])}}" class="custom-link">{{$pCat->name}}</a>
                        
                           
                        </li>
                        @endforeach
                        <!-- /top level parent categories -->

                    
                    </ul>
               
            </li>
            <!-- /categories -->
            <!-- stores -->
            <li class="nav-item" id="s-container">
                <a id="storesTrigger" href="{{route('home')}}" class="nav-link">Stores</a>
                <ul id="s-list" class="shadow bg-white s-list-hide">
                    @foreach($stores as $store)
                        <li>
                            <a href="{{route('front.store', ['storeSlug' => $store->slug])}}" class="custom-link"> {{$store->name}}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <!-- /stores -->
        </ul>

        <ul class="navbar-nav ml-auto mr-4" id="search-box">
                <!-- search -->
            <div id="search-area">

                <form id="search-form" class="form-inline" action="{{route('searchDeals')}}" method="GET">
            
                    <input style="border-radius:0%;border-top-left-radius:4px;border-bottom-left-radius:4px;" placeholder="Search Deals" id="search" type="search" class="form-control" name="q" autocomplete="off" value="{{ $q ?? '' }}" />
                    
                    <button type="submit" style="border-radius:0%" class="btn btn-success"><i class="fas fa-search"></i></button>

                </form>

                <ul id="suggestions">
                </ul>

            </div>
            <!-- /search -->
        </ul>

    </div>

</div>
</nav>
<!--- End Navigation  -->