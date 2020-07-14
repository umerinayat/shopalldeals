<!-- nav-block -->

<nav class="nav-block menu-container shadow-lg">
<a href="/" class="navbar-brand text-left logo-sm mr-0">
<img class="logo-sm" src="{{asset('images/logo.png')}}" alt="shopalldeals">
</a>
    <ul class="ul-base mobile-nav multi-level">
        <li>

            <b><span data-toggle="categories">Categories <i style="display:block;float:right" class="fas fa-arrow-down" style="margin-left:16px"></i></span></b>
            <ul class="single-level ul-base" id="categories" style="clear:both">
                @foreach($categories as $cat)
                <li>
                    <a href="{{route('front.category', ['catSlug' => $cat->slug])}}" >{{$cat->name}}</a>
                </li>
                @endforeach
                @foreach($onlyParentCategories as $pCat)
                <li>
                <a href="{{route('front.category', ['catSlug' => $pCat->slug])}}">{{$pCat->name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        <li>
            <b><span data-toggle="stores">Stores <i style="display:block;float:right" class="fas fa-arrow-down" style="margin-left:16px"></i></span></b>
            <ul class="single-level" id="stores" style="clear:both">
                @foreach($stores as $store)
                <li>
                    <a href="{{route('front.store', ['storeSlug' => $store->slug])}}"> {{$store->name}}</a>
                </li>
                @endforeach
            </ul>
        </li>
        
    </ul>

</nav>
<!-- /nav-block -->