@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.provider_type.show') }}
        </h4>
        <a href="{{ route('admin.provider-types.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form_view_outer">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.provider_type.fields.name') }}:</h6>
                        <p>{{ $providerType->name }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.provider_type.fields.description') }}:</h6>
                        <p>{{ $providerType->description }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.provider_type.fields.status') }}:</h6>
                        <p>{{ config('constant.enums.status.'.$providerType->status) }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.provider_type.fields.created_at') }}:</h6>
                        <p>{{ date("Y-m-d", strtotime($providerType->created_at)) ?? __('global.N/A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
