@extends('admin.layouts.master')

@section('page-title')
    code deals
@endsection

@section('extra-head')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_multiple_tables.css') }}">
@endsection

@section('page-header')
<nav class="breadcrumb-one" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Deals</a></li>
        <li class="breadcrumb-item active" aria-current="page"><span>Code</span></li>
    </ol>
</nav>
@endsection

@section('main-content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                               
                                <table id="ttt" class="table table-striped table-bordered table-hover non-hover" style="width:100%;">
                                    <thead>
                                        <tr>
                                        <th>id</th>

                                            <th>title</th>
                                            <th>Old Price</th>
                                            <th>New Price</th>
                                            <th>Code</th>
            
                                            <th>Category</th>
                                            <th>Store</th>
                                           

                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tfoot>
                                        <tr>
                                        <th>id</th>
                                            <th>title</th>
                                            <th>Old Price</th>
                                            <th>New Price</th>
                                            <th>Code</th>
                                            <th>Category</th>
                                            <th>Store</th>
                                            
                                            
                                            
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection

@section('extra-script')
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
    <script>
    $(document).ready(function () {
        console.log($('#ttt'));
        $('#ttt').DataTable({
            "processing": true,
            "serverSide": true,
            "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                   "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7,
               
            "ajax":{
                     "url": "{{ route('allCodeDeals') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { "data": "old_price" },
                { "data": "new_price" },
                { "data": "code" },

                { "data": "category" },
                { "data": "store" },
                { "data": "options" }
            ]	 

        });
    });
</script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection