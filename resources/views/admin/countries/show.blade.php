@extends('layouts.admin')
@section('title', $pageTitle)
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/jquery.fancybox.min.css') }}">
@endsection
@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.country.show') }} 
        </h4>
        <a href="{{ route('admin.countries.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form_view_outer">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.country.fields.name') }} </h6>
                        <p>{{ $country->name }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.country.fields.description') }} </h6>
                        <p>{{ $country->description }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.country.fields.currency_symbol') }}</h6>
                        <p>{{ $country->currency_symbol }}</p>
                    </div>

                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.country.fields.currency_name') }}</h6>
                        <p>{{ $country->currency_name }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.country.fields.status') }}</h6>
                        <p>{{ config('constant.enums.status.'.$country->status) }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.country.fields.created_at') }}</h6>
                        <p>{{ date("Y-m-d", strtotime($country->created_at)) ?? __('global.N/A') }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.country.fields.flag') }}</h6>
                        <p>
                            @if($country->flag)
                            <a href="{{ asset('storage/' . $country->flag) }}" class="upload_data_img" data-fancybox="gallery">
                                <img src="{{ asset('storage/' . $country->flag) }}" width="50" height="30" alt="Flag">
                            </a>
                            @else
                                No Flag
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('assets/admin/js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-fancybox="gallery"]').fancybox({
            loop: false
        });
    });    
</script>
@endsection