<!-- Category Selection -->
<div class="form-group row">
   
    <label for="category_id" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Parent Category *</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <select class="parent-category js-states form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" value="{{ isset($subCategory) ? $subCategory->category_id : old('category_id') }}">
        <option value="0" disabled selected>Select Parent Catetory</option>    
        @foreach($categories as $category)
                <option value="{{$category->id}}" {{ isset($subCategory) ? ($subCategory->category_id == $category->id ? 'selected' : 0) : ''  }}>{{$category->name}}</option>
            @endforeach
        </select>
        @error('category_id')
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
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ isset($subCategory) ? $subCategory->name : old('name') }}" placeholder="Enter Sub Category Name">
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
        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ isset($subCategory) ? $subCategory->slug : old('slug') }}" placeholder="Enter Sub Category Slug for URL">
        @error('slug')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- /Slug -->
