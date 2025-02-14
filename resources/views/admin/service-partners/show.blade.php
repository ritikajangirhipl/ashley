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
                            <p>{{ $servicePartner->country->name ?? 'N/A' }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.email_address') }}:</h6>
                            <p>{{ $servicePartner->email_address ?? 'N/A' }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.website_address') }}:</h6>
                            <p>{{ $servicePartner->website_address ?? 'N/A' }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.contact_person') }}:</h6>
                            <p>{{ $servicePartner->contact_person ?? 'N/A' }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.status') }}:</h6>
                            <p>{{ config('constant.enums.status.'.$servicePartner->status) }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.contact_address') }}:</h6>
                            <p>{{ $servicePartner->contact_address ?? 'N/A' }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.service_partners.fields.description') }}:</h6>
                            <p>{{ $servicePartner->description ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partners.fields.created_at') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ date("Y-m-d", strtotime($servicePartner->created_at)) ?? __('global.N/A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection