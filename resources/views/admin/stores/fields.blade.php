<!-- Name -->
<div class="form-group row mb-4">
    <label for="name" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Name *</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ isset($store) ? $store->name : old('name') }}" placeholder="Enter Store Name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- Slug -->
<div class="form-group row mb-4">
    <label for="slug" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Slug *</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" id="slug" value="{{ isset($store) ? $store->slug : old('slug') }}" placeholder="Enter Store Slug for URL">
        @error('slug')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- /Slug -->

<!-- Order -->
<div class="form-group row mb-4">
    <label for="order" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Order</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
        <input type="number" class="form-control @error('order') is-invalid @enderror" name="order" id="order" value="{{ isset($store) ? $store->order : 1 }}" placeholder="Enter Store Order">
        @error('order')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- /Order -->
