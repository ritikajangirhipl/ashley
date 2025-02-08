@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.service_partner.show') }}
            </h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partner.fields.name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $servicePartner->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partner.fields.description') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $servicePartner->description ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partner.fields.country') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $servicePartner->country->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partner.fields.contact_address') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $servicePartner->contact_address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partner.fields.email_address') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $servicePartner->email_address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partner.fields.website_address') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $servicePartner->website_address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partner.fields.contact_person') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $servicePartner->contact_person ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.service_partner.fields.status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$servicePartner->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection