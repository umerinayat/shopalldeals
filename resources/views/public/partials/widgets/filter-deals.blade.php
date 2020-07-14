
<div class="container-fluid filter-deals shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <!-- filters-controls action -->
            <div class="filters-controls">
                <button class="btn mt-1 filter-btn" id="filterBtn">
                    <i class="fa fa-filter"></i>  Filter
                </button>
            </div>
            <!-- /filters-controls action -->
            </div>
            <!-- /col-sm-12 -->
        </div>
    </div>
</div>


<!-- filters-controls container -->
<div id="filterContainer" class="container-fluid filters-controls-container shadow-sm" style="display:none">
    <div class="container pt-3">
        <div class="row">
            <!-- deal types  -->
            <div class="col-sm-2">
                <div class="row">
                    <div class="col-sm-8 offset-sm-4">
                        Deal Types
                    </div>
                </div>
                <div class="row mx-2 mt-2">
                    <div class="col-sm-6 offset-sm-6">
                        <input type="checkbox" name="deal" {{ isset($filterOption) ? ( isset($filterOption->deal ) ? 'checked' : '' ) : '' }} class="form-check-input" id="typeDeal">
                        <label class="form-check-label" for="typeDeal">Deal</label>
                    </div>
                </div>
                <div class="row mx-2 mt-3">
                    <div class="col-sm-6 offset-sm-6">
                        <input type="checkbox"  name="code"  {{ isset($filterOption)  ? (  isset($filterOption->code ) ? 'checked' : ''  ) : '' }}  class="form-check-input" id="typeCode">
                        <label class="form-check-label" for="typeCode">Code</label>
                    </div>
                </div>
                <div class="row mx-2 mt-3">
                    <div class="col-sm-6 offset-sm-6">
                        <input type="checkbox" name="coupons" {{ isset($filterOption)  ? (  isset($filterOption->coupon ) ? 'checked' : ''  ) : '' }} class="form-check-input" id="typeCoupon">
                        <label class="form-check-label" for="typeCoupon">Coupon</label>
                    </div>
                </div>
            </div>
            <!-- /deal types  -->
            <!-- categories and stores -->
            <div class="col-sm-2" >
                <div class="row">
                    <div class="col-sm-12">
                        <label for="categoryFilter">Category</label>
                        <select style="height:35px;font-size:14px" class="form-control" id="categoryFilter" name="category">
                            <option value="none">All</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->slug}}">{{$cat->name}}</option>
                            @endforeach
                            
                            @foreach($onlyParentCategories as $pcat)
                                <option value="{{$pcat->slug}}">{{$pcat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label for="storeFilter">Store</label>
                        <select style="height:35px;font-size:14px" class="form-control" id="storeFilter" name="store">
                            <option value="none">All</option>
                            @foreach($stores as $store)
                                <option value="{{$store->slug}}">{{$store->name}}</option>
                            @endforeach
                         </select>
                    </div>
                </div>
            </div>
            <!-- /categories and stores -->
        
            <!-- min-max-price -->
            <div class="col-sm-2">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="minPrice">Min. Price</label>
                        <input style="height:35px;font-size:14px" type="number"  id="minPrice" value="any" min="1" class="form-control" name="min-price" placeholder="Any">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label for="maxPrice">Max. Price</label>
                        <input style="height:35px;font-size:14px" type="number"  min="1" value="any" name="max-price" id="maxPrice" class="form-control" placeholder="Any">
                    </div>
                </div>
            </div>
            <!-- /min-max-price -->

        </div> 
        <!-- /row -->
        <!-- applyFilterBtn -->
        <div class="row mt-4">
            <div class="col-sm-7 offset-sm-5">
                
                <button id="applyFilterBtn" type="submit" class="btn mr-1 btn-primary btn-sm">Apply</button>
                <a href="/">Clear</a>
            </div>
        </div>
        <!-- /applyFilterBtn -->
    </div>
</div>
<!-- /filters-controls container -->
