@extends('admin.layouts.master')


@section('page-title')
    Update Website Settings
@endsection


@section('page-header')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Website Settings</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>General</span></li>
    </ol>
</nav>
@endsection

@section('main-content')
<div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-10 col-md-6 col-sm-6 col-6">
                        <h4>Update Website Settings</h4>
                    </div>   
                                                                                             
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('storeWebisteSettings') }}" method="POST">
                    @csrf
                    

                    @include('admin.website-settings.fields')
                                     
                    
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                        </div>
                    </div>
                </form>

        </div>
    </div>
</div>
@endsection


@section('extra-script')

      <!-- TinyMCE init -->
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
    var editor_config = {
      selector: "textarea.website-terms",
      plugins: [
      "advlist autolink lists link charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save  contextmenu directionality",
      "emoticons paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      height: 129,
    };

    //  website-privacy_policy
    var peditor_config = {
      selector: "textarea.website-privacy_policy",
      plugins: [
      "advlist autolink lists link charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save  contextmenu directionality",
      "emoticons paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      height: 129,
    };


    //website-about-us
    var abeditor_config = {
      selector: "textarea.website-about-us",
      plugins: [
      "advlist autolink lists link charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save  contextmenu directionality",
      "emoticons paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      height: 129,
    };

    tinymce.init(editor_config);
    tinymce.init(peditor_config);
    tinymce.init(abeditor_config);


   

  </script>

@endsection