@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.services.show') }}
            </h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.description') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->description ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.country') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->country->name ?? 'N/A' }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$service->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection