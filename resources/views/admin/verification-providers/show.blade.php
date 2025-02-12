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
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $verificationProvider->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.description') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $verificationProvider->description ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.country') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $verificationProvider->country->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.provider_type') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $verificationProvider->providerType->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.contact_address') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $verificationProvider->contact_address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.email_address') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $verificationProvider->email ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.website') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $verificationProvider->website ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.contact_person') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $verificationProvider->contact_person ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.verification_provider.fields.status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$verificationProvider->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
