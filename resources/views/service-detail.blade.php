@extends('layouts.frontend')
@section('title', $service->name)
@section('styles')
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid row-gap-2" id="kt_content">
    <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex flex-column">
                    <h2 class="text-white font-weight-bold my-2 mr-5">{{$service->name}}</h2>
                    <div class="d-flex align-items-center flex-wrap font-weight-bold my-2 mb-3">
                        <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                            <i class="flaticon2-shelter text-white icon-1x"></i>
                        </a>
                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                        <a href="{{route('catalogue')}}" class="text-white text-hover-white opacity-75 hover-opacity-100">{{trans('panel.catalogue')}}</a>
                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                        <a href="javascript:void(0);" class="text-white text-hover-white opacity-75 hover-opacity-100">{{$service->name}}</a>
                       
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
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="card card-custom card-stretch">
                        <div class="card-body">
                            <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ (($update != 0) ? 'active' : '') }}" id="service-tab" data-toggle="tab" data-target="#service" type="button" role="tab" aria-controls="service" aria-selected="true">
                                        <span class="navi-icon mr-2">
                                            <span class="svg-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path
                                                            d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                                            fill="#000000"
                                                            fill-rule="nonzero"
                                                        ></path>
                                                        <path
                                                            d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                                            fill="#000000"
                                                            opacity="0.3"
                                                        ></path>
                                                    </g>
                                                </svg>
                                            </span>
                                        </span>
                                        <span class="navi-text font-size-lg">
                                            Service Overview
                                        </span>
                                    </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="sample-report-tab" data-toggle="tab" data-target="#sample-report" type="button" role="tab" aria-controls="sample-report" aria-selected="false">
                                        <span class="navi-icon mr-2">
                                            <span class="svg-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                        <path
                                                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                            fill="#000000"
                                                            fill-rule="nonzero"
                                                        ></path>
                                                    </g>
                                                </svg>
                                            </span>
                                        </span>
                                        <span class="navi-text font-size-lg">
                                            Sample Report
                                        </span>
                                    </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="faq-tab" data-toggle="tab" data-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false">
                                        <span class="navi-icon mr-2">
                                            <span class="svg-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                            fill="#000000"
                                                            opacity="0.3"
                                                        ></path>
                                                        <path
                                                            d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                            fill="#000000"
                                                        ></path>
                                                    </g>
                                                </svg>
                                            </span>
                                        </span>
                                        <span class="navi-text font-size-lg">
                                            Faq's
                                        </span>
                                    </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <a class="nav-link {{ (($update == 0) ? 'active' : '') }}" id="order-tab" data-toggle="tab" data-target="#order" type="button" role="tab" aria-controls="order" aria-selected="false">
                                        <span class="navi-icon mr-2">
                                            <span class="svg-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                                                            fill="#000000"
                                                            opacity="0.3"
                                                        ></path>
                                                        <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"></path>
                                                        <path
                                                            d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                                            fill="#000000"
                                                            opacity="0.3"
                                                        ></path>
                                                    </g>
                                                </svg>
                                            </span>
                                        </span>
                                        <span class="navi-text font-size-lg">
                                            Order Forms
                                        </span>
                                    </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="separator separator-dashed my-5"></div>
                            @if(count($otherServices) > 0)
                            <h5 class="font-weight-bold mb-5 pt-2">{{trans('panel.other')}} {{trans('cruds.services.title')}}  {{trans('panel.from')}} {{trans('cruds.services.fields.verification_provider')}}</h5>
                            <ul class="other_provide_services">
                                @foreach ($otherServices as $key => $value )
                                <li><a href="{{route('services.view', encrypt($value->id))}}">{{$value->name}}</a></li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>										
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade  {{ (($update != 0) ? 'show active' : '') }}" id="service" role="tabpanel" aria-labelledby="service-tab">
                            <div class="card card-custom">
                                <div class="card-header py-3">
                                    <div class="card-title">
                                        <h3 class="card-label font-weight-bolder text-dark">{{trans('global.service_info')}}</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="font-weight-bold mb-4 text-blue-light">{{trans('global.summary_info')}}</h5>
                                   <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">{{trans('cruds.services.title_singular')}} {{ trans('cruds.services.fields.country') }}</label>
                                            <span class="col-sm-8">{{ ucwords($service->country->name) ?? __('global.N/A') }}</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">{{trans('cruds.services.title_singular')}} {{ trans('cruds.services.fields.category') }}</label>
                                            <span class="col-sm-8">{{ ucwords($service->category->name) ?? __('global.N/A') }}</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">{{trans('cruds.services.title_singular')}} {{ trans('cruds.services.fields.sub_category') }}</label>
                                            <span class="col-sm-8">{{ ucwords($service->subCategory->name) ?? __('global.N/A') }}</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">{{trans('cruds.services.title_singular')}} {{ trans('cruds.services.fields.name') }}</label>
                                            <span class="col-sm-8">{{ ucwords($service->name) ?? __('global.N/A') }}</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">{{trans('global.verification_info')}}</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">{{ trans('cruds.services.fields.verification_mode') }}</label>
                                            <span class="col-sm-8">{{ $service->verificationMode->name ?? __('global.N/A') }}</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">{{ trans('cruds.services.fields.verification_summary') }}</label>
                                            <span class="col-sm-8">{{ $service->verification_summary ?? __('global.N/A') }}</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">{{ trans('cruds.services.fields.verification_provider') }}</label>
                                            <span class="col-sm-8">{{ $service->verificationProvider->name ?? __('global.N/A') }}</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">{{ trans('cruds.services.fields.verification_duration') }}</label>
                                            <span class="col-sm-8">{{ $service->verification_duration ?? __('global.N/A') }}</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">{{trans('global.evidence_info')}}</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">{{ trans('cruds.services.fields.evidence_type') }}</label>
                                            <span class="col-sm-8">{{ $service->evidenceType->name ?? __('global.N/A') }}</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">{{ trans('cruds.services.fields.evidence_summary') }}</label>
                                            <span class="col-sm-8">{{ $service->evidence_summary ?? __('global.N/A') }}</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">{{trans('global.pricing_info')}}</h5>
                                    <ul class="service_detail_list">
                                        @if(auth()->check())
                                            @if(auth()->check() && $service->country_id == auth()->guard('web')->user()->country_id)
                                            <li class="row">
                                                <label class="col-sm-4">{{trans('global.local_req')}} - {{$service->country->currency_name}}</label>
                                                <span class="col-sm-8">{{ ($service->local_service_price) ? number_format($service->local_service_price, 2, '.', ',') : __('global.N/A') }}</span>
                                            </li>
                                            @else 
                                            <li class="row">
                                                <label class="col-sm-4">{{trans('global.international_req')}} - {{trans('global.usd')}}</label>
                                                <span class="col-sm-8">{{ ($service->usd_service_price) ? number_format($service->usd_service_price, 2, '.', ',') : __('global.N/A') }}</span>
                                            </li>
                                            @endif
                                        @else
                                            <li class="row">
                                                <label class="col-sm-4">{{trans('global.local_req')}} - {{$service->country->currency_name}}</label>
                                                <span class="col-sm-8">{{ ($service->local_service_price) ? number_format($service->local_service_price, 2, '.', ',') : __('global.N/A') }}</span>
                                            </li>
                                            <li class="row">
                                                <label class="col-sm-4">{{trans('global.international_req')}} - {{trans('global.usd')}}</label>
                                                <span class="col-sm-8">{{ ($service->usd_service_price) ? number_format($service->usd_service_price, 2, '.', ',') : __('global.N/A') }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="sample-report" role="tabpanel" aria-labelledby="sample-report-tab">
                            <div class="card card-custom">
                                <div class="card-header py-3">
                                    <div class="card-title">
                                        <h3 class="card-label font-weight-bolder text-dark">Sample Report</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="font-weight-bold mb-4 text-blue-light">Summary Details</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">Service Country</label>
                                            <span class="col-sm-8">Verify Nigeria</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Service Category</label>
                                            <span class="col-sm-8">Nigeria Business Checks</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Service Sub Category</label>
                                            <span class="col-sm-8">Nigeria Company and Director Searches</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Service Name</label>
                                            <span class="col-sm-8">Director Searches</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">Verification Details</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">Verification Mode</label>
                                            <span class="col-sm-8">Database Searches</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Verification Summary</label>
                                            <span class="col-sm-8">Official database search through own or third party direct connections to confirm if subject holds directorships position in any entities</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Verification Provider</label>
                                            <span class="col-sm-8">Corporate Affairs Commission</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Verification Duration</label>
                                            <span class="col-sm-8">7 Working Days</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">Evidence Details</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">Evidence Type </label>
                                            <span class="col-sm-8">Screenshots</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Evidence Summary</label>
                                            <span class="col-sm-8">Screenshots from connectivity search output from databases showing output information which requires manual information comparision.</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">Pricing Details</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">Local Requester - NGN</label>
                                            <span class="col-sm-8">7,500.00</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">International Requester - USD</label>
                                            <span class="col-sm-8">10.00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>										  	
                        </div>
                        <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                            <div class="card card-custom">
                                <div class="card-header py-3">
                                    <div class="card-title">
                                        <h3 class="card-label font-weight-bolder text-dark">Faq's</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="font-weight-bold mb-4 text-blue-light">Summary Details</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">Service Country</label>
                                            <span class="col-sm-8">Verify Nigeria</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Service Category</label>
                                            <span class="col-sm-8">Nigeria Business Checks</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Service Sub Category</label>
                                            <span class="col-sm-8">Nigeria Company and Director Searches</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Service Name</label>
                                            <span class="col-sm-8">Director Searches</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">Verification Details</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">Verification Mode</label>
                                            <span class="col-sm-8">Database Searches</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Verification Summary</label>
                                            <span class="col-sm-8">Official database search through own or third party direct connections to confirm if subject holds directorships position in any entities</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Verification Provider</label>
                                            <span class="col-sm-8">Corporate Affairs Commission</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Verification Duration</label>
                                            <span class="col-sm-8">7 Working Days</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">Evidence Details</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">Evidence Type </label>
                                            <span class="col-sm-8">Screenshots</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">Evidence Summary</label>
                                            <span class="col-sm-8">Screenshots from connectivity search output from databases showing output information which requires manual information comparision.</span>
                                        </li>
                                    </ul>
                                    <div class="separator separator-dashed my-7"></div>
                                    <h5 class="font-weight-bold mb-4 text-blue-light">Pricing Details</h5>
                                    <ul class="service_detail_list">
                                        <li class="row">
                                            <label class="col-sm-4">Local Requester - NGN</label>
                                            <span class="col-sm-8">7,500.00</span>
                                        </li>
                                        <li class="row">
                                            <label class="col-sm-4">International Requester - USD</label>
                                            <span class="col-sm-8">10.00</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>	
                        </div>
                        <div class="tab-pane fade {{ (($update == 0) ? 'show active' : '') }}" id="order" role="tabpanel" aria-labelledby="order-tab">
                            @include('includes.service-order-form')										  	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@endsection