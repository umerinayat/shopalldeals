<!-- Category Selection -->
<div class="form-group row">
   
    <label for="sub_category_id" class="col-xl-1 col-lg-1 col-sm-3 col-form-label">Sub Category*</label>
    <div class="col-xl-10 col-lg-10 col-sm-9">
        <select class="sub-category js-states form-control @error('sub_category_id') is-invalid @enderror" name="sub_category_id" id="sub_category_id" value="{{ isset($childCategory) ? $childCategory->sub_category_id : old('sub_category_id') }}">
        <option value="0" disabled selected>Select Sub Catetory</option>    
        @foreach($subCategories as $category)
                <option value="{{$category->id}}" {{ isset($childCategory) ? ($childCategory->sub_category_id == $category->id ? 'selected' : 0) : ''  }}>{{$category->name}}</option>
            @endforeach
        </select>
        @error('sub_category_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- Category Selection -->

<!-- Name -->
<div class="form-group row mb-4">
    <label for="name" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Name *</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ isset($childCategory) ? $childCategory->name : old('name') }}" placeholder="Enter Child Category Name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- /Name -->

<!-- Slug -->
<div class="form-group row mb-4">
    <label for="slug" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Slug *</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ isset($childCategory) ? $childCategory->slug : old('slug') }}" placeholder="Enter Child Category Slug for URL">
        @error('slug')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- /Slug -->
