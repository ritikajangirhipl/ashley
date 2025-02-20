@extends('layouts.frontend')
@section('title', 'Home')
@section('content')
<div class="content d-flex flex-column flex-column-fluid row-gap-2" id="kt_content">
    <div class="subheader py-2 py-lg-12  subheader-transparent " id="kt_subheader">
        <div class="container d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex flex-column">
                    <h2 class="text-white font-weight-bold my-2 mr-5">Home</h2>
                    <div class="d-flex align-items-center flex-wrap font-weight-bold my-2 mb-3">
                        <a href="{{route('home')}}" class="opacity-75 hover-opacity-100">
                            <i class="flaticon2-shelter text-white icon-1x"></i>
                        </a>
                        <span class="label label-dot label-sm bg-white opacity-75 mx-3"></span>
                        <a href="{{route('home')}}" class="text-white text-hover-white opacity-75 hover-opacity-100">Home</a>
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
            @if(count($countries) > 0)
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center row-gap-2">
                    <h3 class="card-title">{{ trans('cruds.country.title') }}</h3>
                    <a href="{{route('countries')}}" target="_blank" class="view_all_btn">{{ trans('panel.view') }} {{ trans('panel.all') }}</a>
                </div>
                <div class="card-body">
                    <ul class="catalogue_lists">
                        @foreach ($countries as $key => $country )
                            <li><a href="javascript:void(0);" title="{{$country->name}}"><span><img src="{{ asset('storage/' . $country->flag) }}" alt="{{$country->name}}"></span>{{$country->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            @if(count($categories) > 0)
            <div class="card card-custom gutter-b">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center row-gap-2">
                    <h3 class="card-title">{{ trans('cruds.category.title') }}</h3>
                    <a href="{{route('categories')}}" target="_blank" class="view_all_btn">{{ trans('panel.view') }} {{ trans('panel.all') }}</a>
                </div>
                <div class="card-body">
                    <ul class="catalogue_lists">
                        @foreach ($categories as $key => $category)
                            <li><a href="{{route('sub-categories',$category->slug)}}" title="{{$category->name}}"><span><img src="{{ asset('storage/' . $category->image) }}" alt="{{$category->name}}"></span>{{$category->name}}</a></li>
                        @endforeach
                     
                    </ul>
                </div>
            </div>
            @endif
            @if(count($verificationProviders) > 0)
            <div class="card card-custom">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center row-gap-2">
                    <h3 class="card-title">{{ trans('cruds.verification_provider.title') }}</h3>
                    <a href="{{route('verification-providers')}}" target="_blank" class="view_all_btn">{{ trans('panel.view') }} {{ trans('panel.all') }}</a>
                </div>
                <div class="card-body">
                    <ul class="catalogue_lists">
                        @foreach ($verificationProviders as $key => $verificationProvider)
                            <li><a href="javascript:void(0);" title="{{$verificationProvider->name}}">{{$verificationProvider->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
             @endif
        </div>
    </div>
</div>
@endsection