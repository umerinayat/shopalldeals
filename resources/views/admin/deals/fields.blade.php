
<!-- title -->
<div class="form-group mb-4">
    <label for="title">Title</label>
    
    <input type="text" autofocus  class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ isset($deal) ? $deal->title : old('title') }}" placeholder="Enter Deal Title">
        @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div>

<!-- Slug -->
<div class="form-group mb-4">
    <label for="slug">Slug *</label>
    <div>
        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ isset($deal) ? $deal->slug : old('slug') }}" placeholder="Enter Deal Slug for URL">
        @error('slug')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- /Slug -->

<!-- link to deal -->
<div class="form-group mb-4">
    <label for="link_to_deal">Link to deal</label>
    <input type="text" class="form-control @error('link_to_deal') is-invalid @enderror" name="link_to_deal" id="link_to_deal" value="{{ isset($deal) ? $deal->link_to_deal : old('link_to_deal') }}" placeholder="Enter Link To Deal">
    @error('link_to_deal')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<!-- copy_code -->
<div style="display:none" id="copy_code_con" class="form-group mb-4">
    <label for="copy_code">Code</label>
    
    <input type="text"  class="form-control @error('copy_code') is-invalid @enderror" name="copy_code" id="copy_code" value="{{ isset($deal) ? ($deal->deal_type == 'code' ? $deal->codeDeal->copy_code : '') : old('copy_code')}}" placeholder="Enter Deal Copy Code">
        @error('copy_code')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
</div>



<!-- #couponContainer -->
<div style="display:none" id="couponContainer" class="form-row mb-4">

    <div class="form-group col-md-6">
        <label for="coupon">Coupon</label>
        
        <input type="text"  class="form-control @error('coupon') is-invalid @enderror" name="coupon" id="coupon" value="{{ isset($deal) ? ($deal->deal_type == 'coupon' ? $deal->couponDeal->coupon_code : '')  : old('coupon') }}" placeholder="Enter Deal Show Coupon">
            @error('coupon')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group col-md-6">

        <label for="savings">Savings</label>
            <input type="text"  class="form-control @error('savings') is-invalid @enderror" name="savings" id="savings" value="{{ isset($deal) ? ($deal->deal_type == 'coupon' ? $deal->couponDeal->savings : '')  : old('savings') }}" placeholder="Enter Deal Savings">
            @error('savings')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

    </div>
 
</div>

<div class="form-row mb-4" id="priceDetailsContainer">
    <div class="form-group col-md-4">
          <!-- old price -->
        <label for="old_price">Old Price</label>
        <input type="text"  class="form-control @error('old_price') is-invalid @enderror" name="old_price" id="old_price" value="{{ isset($deal) ? $deal->old_price : old('old_price') }}" placeholder="Enter Old Price">
        @error('old_price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <!-- new price -->
        <label for="new_price">New Price</label>
        <input type="text" class="form-control @error('new_price') is-invalid @enderror" name="new_price" id="new_price" value="{{ isset($deal) ? $deal->new_price : old('new_price') }}" placeholder="Enter New Price">
        @error('new_price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <!-- discount -->
        <label for="discount">Discount</label>
        <input type="text" class="form-control @error('discount') is-invalid @enderror" name="discount" id="discount" value="{{ isset($deal) ? $deal->discount : old('discount') }}" placeholder="Enter Discount">
        @error('discount')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- categories  -->
    <!-- categories -->
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <!-- select deal category -->
                <label for="category_id">Category</label>
                <select class="deal-category js-states form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" value="">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <!-- sub categories -->
                    <div class="form-group" id="subCatsContainer">
                    <label for="subcategory_id">Sub Category</label>
                    <select class="js-states form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" id="subcategory_id" value="">
                        <!-- dynamic options -->
                    </select>
                    @error('subcategory_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <!-- /sub categories -->
                    <div class="form-group" id="childCatsContainer">
                        <label for="childcategory_id">Child Category</label>
                        <select class="js-states form-control @error('childcategory_id') is-invalid @enderror" name="childcategory_id" id="childcategory_id" value="">
                        <!-- dynamic options -->
                    </select>
                    @error('childcategory_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                <!-- child categoires -->

                <!-- child categories -->
            </div>
        </div>


    </div>
    <!-- /categories -->

<!-- stores -->
<div class="form-group">
    <label for="store_id">Store</label>
    <select class="deal-store js-states form-control @error('store_id') is-invalid @enderror" name="store_id" id="store_id" value="{{ isset($deal) ? $deal->store_id : old('store_id') }}">
        
        @foreach($stores as $store)
            <option value="{{$store->id}}" {{ isset($deal) ? ($store->name == $deal->store ? 'selected' : 0 ) : ''  }} >{{$store->name}}</option>
        @endforeach
        
    </select>
    @error('store_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
<!-- /stores -->


<!-- is_free_shipping -->
<div class="form-group mb-4">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="is_free_shipping"  {{isset($deal) ? ($deal->is_free_shipping == 1 ? 'checked' : '') : ''}} id="is_free_shipping">
        <label class="custom-control-label" for="is_free_shipping">Is Free Shipping?</label>
    </div>
</div>

<!-- is_expired -->
<div class="form-group mb-4">
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="is_expired"  {{isset($deal) ? ($deal->is_expired == 1 ? 'checked' : '') : ''}} id="is_expired">
        <label class="custom-control-label" for="is_expired">Is xpired?</label>
    </div>
</div>

<!-- short description -->
<div class="form-group mb-4">
    <label for="short_description">Short Description</label>
    <textarea class="@error('short_description') is-invalid @enderror form-control" value="{{isset($deal) ? $deal->short_description : old('short_description')}}" id="short_description" name="short_description">{{isset($deal) ? $deal->short_description : old('short_description')}}</textarea>
    @error('short_description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<!-- Description -->
<div class="form-group mb-4">
    <label for="des">Deal Content</label>
    <!-- text editor -->
    <textarea class="my-editor @error('description') is-invalid @enderror" value="{{isset($deal) ? $deal->description : old('description')}}" id="description" name="description">{{isset($deal) ? $deal->description : old('description')}}</textarea>
    @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<!-- image -->
<div class="form-group mb-4">
    
    <div class="custom-file-container" data-upload-id="myFirstImage">
        @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <label>Upload Featured Image <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
        <label class="custom-file-container__custom-file" >
            <input name="image" type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*">
            <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
            <span class="custom-file-container__custom-file__custom-file-control"></span>
        </label>
        <div class="custom-file-container__image-preview"></div>
    </div>
    
</div>

<input type="hidden" name="deal_type" value="deal" id="dealTypeField">



