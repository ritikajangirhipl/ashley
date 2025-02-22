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
                    <h2 class="text-white font-weight-bold my-2 mr-5">{{ trans('panel.catalogue') }}</h2>
                    <div class="d-flex align-items-center flex-wrap font-weight-bold my-2 mb-3">
                        <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                            <i class="flaticon2-shelter text-white icon-1x"></i>
                        </a>
                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                        <a href="{{route('catalogue')}}" class="text-white text-hover-white opacity-75 hover-opacity-100">{{ trans('panel.catalogue') }}</a>
                    </div>
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
                <form class="form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Country</label>
                                    <select class="form-control select2" id="verification_country" name="param">
                                        <option label="Search and Filter by Select Country"></option>
                                        <option>Plateau State</option>
                                        <option>Edo State</option>
                                        <option>FCT Abuja</option>
                                        <option>Plateau State</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Provider Type</label>
                                    <select class="form-control select2" id="verification_provider_type" name="param">
                                        <option label="Search and Filter by Select Verification Provider Type"></option>
                                        <option>University of ABC</option>
                                        <option>ABC Consulting Company Limited</option>
                                        <option>XYZ Civil Organization</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Provider</label>
                                    <select class="form-control select2" id="verification_provider" name="param">
                                        <option label="Search and Filter by Select Verification Provider"></option>
                                        <option>University of ABC</option>
                                        <option>ABC Consulting Company Limited</option>
                                        <option>XYZ Civil Organization</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Subject</label>
                                    <input type="text" class="form-control" placeholder="Search and Filter by Verification Subject">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Category</label>
                                    <select class="form-control select2" id="verification_category" name="param">
                                        <option label="Search and Filter by Select Category"></option>
                                        <option>Ministry of Environment</option>
                                        <option>NYSC</option>
                                        <option>Ministry of Tourism</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Area</label>
                                    <select class="form-control select2" id="verification_area" name="param">
                                        <option label="Search and Filter by Select Sub Category"></option>
                                        <option>Verification Area 1</option>
                                        <option>Verification Area 2</option>
                                        <option>Verification Area 3</option>
                                        <option>Verification Area 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Verification Mode</label>
                                    <select class="form-control select2" id="verification_mode" name="param">
                                        <option label="Search and Filter by Select Verification Mode"></option>
                                        <option>Verification Mode 1</option>
                                        <option>Verification Mode 2</option>
                                        <option>Verification Mode 3</option>
                                        <option>Verification Mode 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Evidence Type</label>
                                    <select class="form-control select2" id="evidence_type" name="param">
                                        <option label="Search and Filter by Select Evidence Type"></option>
                                        <option>Evidence Type 1</option>
                                        <option>Evidence Type 2</option>
                                        <option>Evidence Type 3</option>
                                        <option>Evidence Type 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Free Text Search</label>
                                    <input type="text" class="form-control" placeholder="Input Search Text">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 text-right">
                                <button class="btn btn-primary min-w-130px">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h3 class="card-label">Verification Services</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table_search">
                        <div class="input-icon">
                            <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                    <g clip-path="url(#clip0_403_44)">
                                    <path d="M13.8672 13.2383L10.2526 9.68153C11.1991 8.65314 11.7807 7.29308 11.7807 5.79648C11.7803 2.59497 9.14327 0 5.89013 0C2.63699 0 0 2.59497 0 5.79648C0 8.99799 2.63699 11.593 5.89013 11.593C7.29571 11.593 8.58488 11.1068 9.59751 10.2985L13.2261 13.8694C13.4029 14.0435 13.6899 14.0435 13.8668 13.8694C14.044 13.6952 14.044 13.4125 13.8672 13.2383ZM5.89013 10.7011C3.13762 10.7011 0.906279 8.50525 0.906279 5.79648C0.906279 3.0877 3.13762 0.891822 5.89013 0.891822C8.64266 0.891822 10.874 3.0877 10.874 5.79648C10.874 8.50525 8.64266 10.7011 5.89013 10.7011Z" fill="#B5B5C3"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_403_44">
                                    <rect width="14" height="14" fill="white"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="mb-5 collapse" id="kt_datatable_group_action_form">
                        <div class="d-flex align-items-center">
                            <div class="font-weight-bold text-danger mr-3">
                                Selected <span id="kt_datatable_selected_records">0</span> records:
                            </div>
                            <div class="dropdown mr-2">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Update status
                                </button>
                                <div class="dropdown-menu dropdown-menu-sm">
                                    <ul class="nav nav-hover flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <span class="nav-text">Pending</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <span class="nav-text">Delivered</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <span class="nav-text">Canceled</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-danger mr-2" type="button" id="kt_datatable_delete_all">
                                Delete All
                            </button>
                        </div>
                    </div>
                    <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
                </div>
            </div> --}}
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap">
                    <div class="card-title">
                        <h3 class="card-label">Verification Services</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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

@endsection