@extends('layouts.frontend')
@section('title', trans('panel.catalogue'))
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/data-tables/css/datatables.min.css') }}">
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid row-gap-2" id="kt_content">
    <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex flex-column">
                    @if(count($dataArr) > 0)
                        @switch($dataArr['type'])
                            @case('country')
                                <h2 class="text-white font-weight-bold my-2 mr-5">{{$dataArr['name']}}</h2>
                                <div class="d-flex align-items-center flex-wrap font-weight-bold my-2 mb-3">
                                    <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                                        <i class="flaticon2-shelter text-white icon-1x"></i>
                                    </a>
                                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                    <a href="{{route('countries')}}" class="text-white text-hover-white opacity-75 hover-opacity-100">{{ trans('panel.all') }} {{ trans('cruds.country.title') }}</a>
                                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                    <a href="javascript:void(0);" class="text-white text-hover-white opacity-75 hover-opacity-100">{{$dataArr['name']}}</a>
                                </div>
                                @break
                            @case('providers')
                                    <h2 class="text-white font-weight-bold my-2 mr-5">{{$dataArr['name']}}</h2>
                                    <div class="d-flex align-items-center flex-wrap font-weight-bold my-2 mb-3">
                                        <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                                            <i class="flaticon2-shelter text-white icon-1x"></i>
                                        </a>
                                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                        <a href="{{route('verification-providers')}}" class="text-white text-hover-white opacity-75 hover-opacity-100">{{ trans('panel.all') }} {{ trans('cruds.verification_provider.title') }}</a>
                                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                        <a href="javascript:void(0);" class="text-white text-hover-white opacity-75 hover-opacity-100">{{$dataArr['name']}}</a>
                                    </div>
                                @break
                            @case('category')
                                <h2 class="text-white font-weight-bold my-2 mr-5">{{$dataArr['category_name']}}</h2>
                                <div class="d-flex align-items-center flex-wrap font-weight-bold my-2 mb-3">
                                    <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                                        <i class="flaticon2-shelter text-white icon-1x"></i>
                                    </a>
                                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                    <a href="{{route('sub-categories',$dataArr['category_slug'])}}" class="text-white text-hover-white opacity-75 hover-opacity-100">{{$dataArr['category_name']}}</a>
                                    <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                                    <a href="javascript:void(0);" class="text-white text-hover-white opacity-75 hover-opacity-100">{{$dataArr['name']}}</a>
                                </div>
                                @break
                        @endswitch
                    @else
                        <h2 class="text-white font-weight-bold my-2 mr-5">{{ trans('panel.catalogue') }}</h2>
                        <div class="d-flex align-items-center flex-wrap font-weight-bold my-2 mb-3">
                            <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                                <i class="flaticon2-shelter text-white icon-1x"></i>
                            </a>
                            <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                            <a href="{{route('catalogue')}}" class="text-white text-hover-white opacity-75 hover-opacity-100">{{ trans('panel.catalogue') }}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="alert alert-custom alert-white alert-shadow gutter-b" role="alert">
                <div class="alert-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"/>
                                <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg>
                    </span>
                </div>
                <div class="alert-text">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                </div>
            </div>
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">
                        Search Our Verification Services Catalogue
                    </h3>
                </div>
<<<<<<< HEAD
                <form class="form" action="javascript:void(0);" id="searchService">
=======
                <form class="form" id="searchService">
>>>>>>> bd0a5b3 (catalogue page apply custom filters)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Country</label>
                                    <select class="form-control select2" id="verification_country" name="verification_country">
                                        <option label="Search and Filter by Select Country" value=''>Search and Filter by Select Country</option>
                                        @foreach ($countries as $countryKey => $country )
                                        <option value='{{$country->id}}'>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Provider Type</label>
                                    <select class="form-control select2" id="verification_provider_type" name="verification_provider_type">
                                        <option label="Search and Filter by Select Verification Provider Type" value="">Search and Filter by Select Verification Provider Type</option>
                                        @foreach ($providerTypes as $providerTypeKey => $providerType )
                                            <option value='{{$providerType->id}}'>{{$providerType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Provider</label>
                                    <select class="form-control select2" id="verification_provider" name="verification_provider">
                                        <option label="Search and Filter by Select Verification Provider"></option>
                                        @foreach ($verificationProviders as $verificationProviderKey => $verificationProvider )
                                            <option value='{{$verificationProvider->id}}'>{{$verificationProvider->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Subject</label>
                                    {{-- <input type="text" class="form-control" placeholder="Search and Filter by Verification Subject" name="verification_subject"> --}}
                                    <select class="form-control select2" id="verification_subject" name="verification_subject">
                                        <option label="Search and Filter by Verification Subject"></option>
                                        @foreach(config('constant.enums.subjects') as $id => $name)
                                            <option value='{{$id}}'>{{$name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Category</label>
                                    <select class="form-control select2" id="verification_category" name="verification_category">
                                        <option label="Search and Filter by Select Category" value=""></option>
                                        @foreach ($categories as $categoriesKey => $category )
                                            <option value='{{$category->id}}'>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Sub Category</label>
                                    <select class="form-control select2" id="verification_subcategory" name="verification_subcategory">
                                        <option label="Search and Filter by Select Sub Category" value=""></option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Mode</label>
                                    <select class="form-control select2" id="verification_mode" name="verification_mode">
                                        <option label="Search and Filter by Select Verification Mode"></option>
                                        @foreach ($verificationModes as $verificationModeKey => $verificationMode )
                                            <option value='{{$verificationMode->id}}'>{{$verificationMode->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Evidence Type</label>
                                    <select class="form-control select2" id="evidence_type" name="evidence_type">
                                        <option label="Search and Filter by Select Evidence Type"></option>
                                        @foreach ($evidenceTypes as $evidenceTypeKey => $evidenceType )
                                            <option value='{{$evidenceType->id}}'>{{$evidenceType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Free Text Search</label>
                                    <input type="text" class="form-control" placeholder="Input Search Text" name="free_text_search">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 text-right">
                                <button type="button" class="btn btn-default min-w-130px" id="searchReset"><i class="flaticon2-refresh icon-1x"></i> Reset</button>
                                <button type="submit" class="btn btn-primary min-w-130px">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h3 class="card-label">Verification Services</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive verification-services-table">
                        <div class="clearfix"></div>
                        {{ $dataTable->table(['class' => 'display table nowrap table-hover', 'id' => 'services-table', 'style' => 'width:100%;']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/admin/plugins/data-tables/js/datatables.min.js') }}" defer></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js')}}" defer></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" defer></script>
{!! $dataTable->scripts() !!}
<script>
    var datatableUrl =  "{{ route('catalogue') }}";
    var dataArray = @json($dataArr);
    $(document).ready(function () {
        if (dataArray || Object.keys(dataArray).length > 0) {
           switch (dataArray.type) {
                case "country":
                    $(document).find('#verification_country').val(dataArray.id).change();
                    $(document).find("#verification_country").addClass("disableSelect");
<<<<<<< HEAD
                    updateDataTable();
                    break;
                case "category":
                    $(document).find('#verification_category').val(dataArray.category_id);
                    setTimeout(()=>{
                        $(document).find('#verification_category').change();
                    },100);
=======
                    break;
                case "category":
                    $(document).find('#verification_category').val(dataArray.category_id).change();
                    //$(document).find("#verification_category").trigger("change");
>>>>>>> fac1cb9 (conflict resolve)
                    $(document).find("#verification_category").addClass("disableSelect");

                    break;
                case "providers":
                    $(document).find('#verification_provider').val(dataArray.id).change();
                    $(document).find("#verification_provider").addClass("disableSelect");
<<<<<<< HEAD
                    updateDataTable();
=======
>>>>>>> fac1cb9 (conflict resolve)
                    break;
                default:
                    break;
            }
        } 
        $(document).on('change','#verification_category', function() {
<<<<<<< HEAD
=======
            alert('dsfsd')
>>>>>>> fac1cb9 (conflict resolve)
            var category_id = $(this).val();
             console.log(category_id);
            $('#verification_subcategory').prop('disabled', true).html('<option value="">{{ trans("global.please_select") }}</option>');

            if (category_id) {
                $.ajax({
                    url: "{{ route('subcategories.getSubCategories') }}",
                    type: "POST",
                    data: { category_id: category_id },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        console.log("Request is being sent...");
                    },
                    success: function(response) {
                        
                        let emptyTxt = "{{ 'Select ' . trans('cruds.services.fields.sub_category') }}";
                        let html = '<option value="">' + emptyTxt + '</option>';
                        if (response.sub_categories && Object.keys(response.sub_categories).length > 0) {
                            $.each(response.sub_categories, function(key, value) {
                                html += '<option value="' + key + '">' + value + '</option>';
                            });
                        } else {
                            html += '<option value="">{{ trans("global.no_sub_categories_found") }}</option>';
                        }
                        $('#verification_subcategory').html(html).prop('disabled', false);
                        if (dataArray || Object.keys(dataArray).length > 0) {
                            if(dataArray.type == 'category'){
                                $(document).find('#verification_subcategory').val(dataArray.id).change();
                                $(document).find('#verification_subcategory').addClass("disableSelect");
<<<<<<< HEAD
                                updateDataTable();
=======
>>>>>>> fac1cb9 (conflict resolve)
                            }
                        }
                    },
                    error: function(xhr) {
                        console.log('AJAX error:', xhr);
                    },
                    complete: function() {
                        console.log("Request completed.");
                    }
                });
            }
        });

        $(document).on('click', '#searchReset', function(e){
            e.preventDefault();
            $('#searchService').find('input, select').each(function() {
                if ($(this).is('select')){
                    $(this).val('').change();
                } else {
                    $(this).val('');
                }
                
            });
            if (dataArray || Object.keys(dataArray).length > 0) {
                switch (dataArray.type) {
                    case "country":
                        $(document).find('#verification_country').val(dataArray.id).change();
                        $(document).find("#verification_country").addClass("disableSelect");
                        updateDataTable();
                        break;
                    case "category":
                        $(document).find('#verification_category').val(dataArray.category_id);
                        setTimeout(()=>{
                            $(document).find('#verification_category').change();
                        },100);
                        $(document).find("#verification_category").addClass("disableSelect");

                        break;
                    case "providers":
                        $(document).find('#verification_provider').val(dataArray.id).change();
                        $(document).find("#verification_provider").addClass("disableSelect");
                        updateDataTable();
                        break;
                    default:
                        break;
                }
            } else {
                updateDataTable();
            }
            
        });
    });

    function updateDataTable(){
        let params = {};
        $('#searchService').find('input, select').each(function() {
            let name = $(this).attr('name'); 
            let value = $(this).val();
            if (name && value !== null && value !== undefined && value !== '') {
                params[name] = value;
            }
        });
        $('#services-table').DataTable().ajax.url(datatableUrl+'?'+$.param(params)).draw();
    }
</script>

@endsection