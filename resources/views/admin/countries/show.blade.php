@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.country.show') }} 
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.country.fields.name') }} :</b></h6>
                    <p class="ml-2 mb-0">{{ $country->name }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.country.fields.description') }} :</b></h6>
                    <p class="ml-2 mb-0">{{ $country->description }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.country.fields.flag') }}:</b></h6>
                    <p class="ml-2 mb-0">
                        @if($country->flag)
                            <img src="{{ asset('storage/' . $country->flag) }}" width="50" height="30" alt="Flag">
                        @else
                            No Flag
                        @endif
                    </p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.country.fields.currency_symbol') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $country->currency_symbol }}</p>
                </div>

                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.country.fields.currency_name') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $country->currency_name }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                <h6 class="mb-0"><b>{{ trans('cruds.country.fields.status') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$country->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection