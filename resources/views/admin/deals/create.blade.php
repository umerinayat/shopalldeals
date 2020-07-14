@extends('admin.layouts.master')


@section('page-title')
    add new deal
@endsection

@section('extra-head')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css') }}">
    <link href="{{ asset('plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('page-header')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Deals</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Add New</span></li>
    </ol>
</nav>
@endsection

@section('main-content')
<div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">                                
                <div class="row">
                    <div class="col-xl-10 col-md-6 col-sm-6 col-6">
                    <h4 style="display:inline-block">Add New Deal</h4>
                        <select style="width:165px" id="deal_type" class="custom-select custom-select-sm">
                            <option disabled>Select Deal Type</option>
                            <option   {{old('deal_type') == 'deal' ? 'selected' : ''}} value="deal">Deal</option>
                            <option  {{old('deal_type') == 'code' ? 'selected' : ''}} value="code">Deal with Code</option>
                            <option  {{old('deal_type') == 'coupon' ? 'selected' : ''}} value="coupon">Deal with Coupon</option>
                        </select>

                    </div>   
                    <div class="col-xl-2 col-md-6 col-sm-6 col-6 text-right mt-3">
                    <a href="{{route('deals.index')}}" class="btn mr-2 btn-outline-primary btn-rounded mb-2">View All</a>
                    </div>                                                                          
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{ route('deals.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('admin.deals.fields')
                                     
                    
                    <div class="form-group row mt-2">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-block btn-primary mt-3">Add</button>
                        </div>
                    </div>
                </form>


        </div>
    </div>
</div>
@endsection

@section('extra-script')
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>

    <script src="{{ asset('plugins/file-upload/file-upload-with-preview.min.js') }}"></script>
   

    <script> 

        $('#subCatsContainer').css('display', 'none');
        $('#childCatsContainer').css('display', 'none');


        $catSelect = $("#category_id").select2({
            placeholder: "Select Category",
            allowClear: true
        });
        $catSelect.val('');
        $catSelect.trigger('change');

        $catSelect.on('change', function (e) {
            console.log($catSelect.val());
            var category_id = $catSelect.val();
            // get sub categoires
            getSelectOptionsHtml('getSubCategories', category_id, getSubCategoriesOptions);
        });

      

        
        $storeSelect = $("#store_id").select2({
            placeholder: "Choose Deal Store",
            allowClear: true
        });
        $storeSelect.val('');
        $storeSelect.trigger('change');

        relatedDealsSelect = $("#related-deals").select2({
            placeholder: "Choose Deal Store",
            allowClear: true
        }); 

 
        //First upload
        var firstUpload = new FileUploadWithPreview('myFirstImage')
        firstUpload.refreshPreviewPanel();

        $dealTypeField = $('#dealTypeField');

        $dealTypeSelect = $('#deal_type');
        $dealTypeSelect.val('deal').prop('selected', true);
        $dealTypeField.val("deal");

         // deal_type => deal => hide copy code field and copoun
        // deal_type => code => display copy code field
        $copyCodeContainer = $('#copy_code_con');
        $couponContainer = $('#couponContainer');
        $priceDetailsContainer = $('#priceDetailsContainer');

    
        {!! old('deal_type') == 'code' ? '$copyCodeContainer.css("display", "block")' : '' !!}
        {!! old('deal_type') == 'code' ? '$dealTypeField.val("code");' : '' !!}
        {!! old('deal_type') == 'code' ? '$dealTypeSelect.val("code").prop("selected", true);' : '' !!}
        
        
        {!! old('deal_type') == 'coupon' ? '$priceDetailsContainer.css("display", "none")' : '' !!}
        {!! old('deal_type') == 'coupon' ? '$couponContainer.css("display", "flex")' : '' !!}
        {!! old('deal_type') == 'coupon' ? '$dealTypeField.val("coupon");' : '' !!}
        {!! old('deal_type') == 'coupon' ? '$dealTypeSelect.val("coupon").prop("selected", true);' : '' !!}


        $dealTypeSelect.on('change', function (evt) {
          
            switch ($dealTypeSelect.val())
            {
                case 'deal':
                    $priceDetailsContainer.css('display', 'flex');
                    $copyCodeContainer.css('display', 'none');
                    $couponContainer.css('display', 'none');
                  
                    $dealTypeField.val('deal');
                break;
                case 'code':
                    $priceDetailsContainer.css('display', 'flex');
                    $copyCodeContainer.css('display', 'block');
                    $couponContainer.css('display', 'none');
                   
                    $dealTypeField.val('code');
                break;
                case 'coupon':
                    $priceDetailsContainer.css('display', 'none');
                    $copyCodeContainer.css('display', 'none');
                    $couponContainer.css('display', 'flex');
                    
                    $dealTypeField.val('coupon');
                break;
            }
        });

        function reset_options() {
            document.getElementById('deal_type').options.length = 0;
            return true;
        }

    </script>

<!-- script handles dynamic categories -->
<script> 
    // #subcategory_id

    var baseUrl = '/admin/categories/';

    function getSelectOptionsHtml (endPoint, id, callback) 
    {
        var url = baseUrl + endPoint + '/' + id;

        $.ajax({
         url: url,
         type: "GET",
         beforeSend: function(xhr){xhr.setRequestHeader('X_REQUESTED_WITH', 'XMLHttpRequest');},
         success: function(data) { 
             console.log(data);
             if(data.success) {
                 if(data.optionsHtml) {
                    callback(isOptions=true, data.optionsHtml);
                 } else 
                 {
                    callback(isOptions=false, data.optionsHtml);
                 }
             } 
        }
      });
    }

    getSubCategoriesOptions = function (isOptions, optionsHtml) 
    {
        if ( isOptions ) {
            $('#subcategory_id').html(optionsHtml);
            $('#subcategory_id').prop('disabled', false);
            $select2 = $('#subcategory_id').select2({
                placeholder: "Select Sub Category",
                allowClear: true
            });
            $select2.val('');
            $select2.trigger('change');
            $select2.on('change', function(e) {
                console.log($(this).val());
                var subcategory_id = $(this).val();
                // get child categores 
                getSelectOptionsHtml('getChildCategories', subcategory_id, getChildCategoriesOptions);
            });
            $('#subCatsContainer').css('display', 'block');
        } else {
            $('#subcategory_id').select2('val', '');
            $('#subcategory_id').prop('disabled', true);
            $('#childcategory_id').select2('val', '');
            $('#childcategory_id').prop('disabled', true);
            $('#subCatsContainer').css('display', 'none');
            $('#childCatsContainer').css('display', 'none');
        }
    }

    getChildCategoriesOptions = function ( isOptions, optionsHtml ) {
        if (isOptions) {
            console.log(optionsHtml);
            // childcategory_id
            // childCatsContainer
            $('#childcategory_id').html(optionsHtml);
            $('#childcategory_id').prop('disabled', false);
            $select2 = $('#childcategory_id').select2({
                placeholder: "Select Child Category",
                allowClear: true
            });
            $select2.val('');
            $select2.trigger('change');
            $('#childCatsContainer').css('display', 'block');
        } else {
            $('#childcategory_id').select2('val', '');
            $('#childcategory_id').prop('disabled', true);
            $('#childCatsContainer').css('display', 'none');
        }
    }

    // get sub categoires
   // getSelectOptionsHtml('getSubCategories', 2, $('#subcategory_id'));
    // get child categories
    //getSelectOptionsHtml('getChildCategories', 2);

 

</script>
<!-- /script handles dynamic categoires -->

  <!-- TinyMCE init -->
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
    var route_prefix = "/filemanager";
    var editor_config = {
      path_absolute : "",
      selector: "textarea.my-editor",
      plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      height: 129,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);
  </script>

@endsection