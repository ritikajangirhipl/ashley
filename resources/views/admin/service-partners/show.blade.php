@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.service_partners.show') }}
            </h4>
            <a href="{{ route('admin.service-partners.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form_view_outer">
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.name') }}:</h6>
                            <p>{{ $servicePartner->name }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.country') }}:</h6>
                            <p>{{ $servicePartner->country->name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.email_address') }}:</h6>
                            <p>{{ $servicePartner->email_address ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.website_address') }}:</h6>
                            <p>{{ $servicePartner->website_address ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.contact_person') }}:</h6>
                            <p>{{ $servicePartner->contact_person ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.status') }}:</h6>
                            <p>{{ config('constant.enums.status.'.$servicePartner->status) }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.contact_address') }}:</h6>
                            <p>{{ $servicePartner->contact_address ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.description') }}:</h6>
                            <p>{{ $servicePartner->description ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.created_at') }}:</h6>
                            <p>{{ date("Y-m-d", strtotime($servicePartner->created_at)) ?? __('global.N/A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection