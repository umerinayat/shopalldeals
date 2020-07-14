  <!--  BEGIN SIDEBAR  -->
  <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">
                <div class="shadow-bottom"></div>

                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="/admin" data-active="true" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="#categories" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                                <span> Categories </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled " id="categories" data-parent="#accordionExample">
                            <li>
                                <a  href="{{ route('categories.create') }}"> Add New </a>
                            </li> 
                            
                            <li>
                                <a href="{{ route('categories.index') }}"> View All </a>
                            </li>
                            <li>
                                <a href="#subCategories" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Sub Categories <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                <ul class="collapse list-unstyled sub-submenu" id="subCategories" data-parent="#categories"> 
                                    
                                    <li>
                                        <a href="{{route('sub_categories.create')}}"> Add New </a>
                                    </li>
                                    <li>
                                        <a href="{{route('sub_categories.index')}}"> View All</a>
                                    </li>
                                    <li>
                                        <a href="#childCategories" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Child Categories <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg> </a>
                                        <ul class="collapse list-unstyled sub-submenu" id="childCategories" data-parent="#subCategories"> 
                                            
                                            <li>
                                                <a href="{{route('child_categories.create')}}"> Add New </a>
                                            </li>
                                            <li>
                                                <a href="{{route('child_categories.index')}}"> View All</a>
                                            </li>
                                        </ul>
                                    </li>

                                </ul>
                            </li>
                     
                        </ul>
                    </li>

                  

                    <li class="menu">
                        <!-- Stores -->
                        <a href="#stores" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                <span> Stores </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled " id="stores" data-parent="#accordionExample">
                            <li>
                                <a  href="{{ route('stores.create') }}"> Add New </a>
                            </li>  
                            <li class="">
                                <a href="{{ route('stores.index') }}"> View All </a>
                            </li>
                                                     
                        </ul>
                    </li>


                        <li class="menu">
                        <!-- Stores -->
                         <a href="#deals" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                <span> Deals </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled " id="deals" data-parent="#accordionExample">
                            <li>
                                <a  href="{{ route('deals.create') }}"> Add New </a>
                            </li> 
                            <li class="">
                                <a href="{{ route('simpleDeals') }}"> Simple </a>
                            </li>
                            <li class="">
                                <a href="{{ route('codeDeals') }}"> Code </a>
                            </li>
                            <li class="">
                                <a href="{{ route('couponDeals') }}"> Coupon </a>
                            </li>
                            <li class="">
                                <a href="{{ route('deals.index') }}"> View All </a>
                            </li>
                                                     
                        </ul>
                        

                    </li>

                    <li class="menu">
                        <a href="#website-settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                                <span> Settings </span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled " id="website-settings" data-parent="#accordionExample">
                            <li>
                                <a  href="{{ route('website_settings.edit') }}"> Website </a>
                            </li>  
                            
                                                     
                        </ul>

                    </li>

                    
                </ul>
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->