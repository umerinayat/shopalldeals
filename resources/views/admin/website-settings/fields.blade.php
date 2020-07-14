<input type="hidden" name="id" value="{{$websiteSetting->id}}">


<!-- privacy_policy_text -->
<div class="form-group row mb-4">
    <label for="privacy_policy_text" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Privacy policy</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
         
        <textarea placeholder="Write privacy policy" value="{{  $websiteSetting->privacy_policy_text  }}" name="privacy_policy_text" id="privacy_policy_text" rows="4" class="website-privacy_policy form-control @error('privacy_policy_text') is-invalid @enderror">{{$websiteSetting->privacy_policy_text}}</textarea>
        @error('privacy_policy_text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- privacy_policy_text -->

<!-- termsnc  -->
<div class="form-group row mb-4">
    <label for="termsnc_text" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">Terms and conditions</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
         
        <textarea placeholder="Write Terms and conditions" value="{{  $websiteSetting->termsnc_text  }}" name="termsnc_text" id="termsnc_text" rows="4" class="website-terms form-control @error('termsnc_text') is-invalid @enderror">{{$websiteSetting->termsnc_text}}</textarea>
        @error('termsnc_text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- termsnc -->

<!-- about_us  -->
<div class="form-group row mb-4">
    <label for="about_us" class="col-xl-1 col-sm-3 col-sm-2 col-form-label">About us</label>
    <div class="col-xl-10 col-lg-9 col-sm-10">
         
        <textarea placeholder="Write about us" value="{{  $websiteSetting->about_us  }}" name="about_us" id="about_us" rows="4" class="website-about-us form-control @error('about_us') is-invalid @enderror">{{$websiteSetting->about_us}}</textarea>
        @error('about_us')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<!-- about_us -->



