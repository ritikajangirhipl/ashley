@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ trans('panel.page_title.verification_provider.show') }}
            </h4>
            <a href="{{ route('admin.verification-providers.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form_view_outer">
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.name') }}</h6>
                            <p>{{ $verificationProvider->name }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.country') }}</h6>
                            <p>{{ $verificationProvider->country->name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.provider_type') }}</h6>
                            <p>{{ $verificationProvider->providerType->name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.email') }}</h6>
                            <p>{{ $verificationProvider->email ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.website') }}</h6>
                            <p>{{ $verificationProvider->website ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.contact_person') }}</h6>
                            <p>{{ $verificationProvider->contact_person ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.status') }}</h6>
                            <p>{{ config('constant.enums.status.'.$verificationProvider->status) }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.contact_address') }}</h6>
                            <p>{{ $verificationProvider->contact_address ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.description') }}</h6>
                            <p>{{ $verificationProvider->description ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.verification_provider.fields.created_at') }}</h6>
                            <p>{{ date("Y-m-d", strtotime($verificationProvider->created_at)) ?? __('global.N/A') }}</p>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection
