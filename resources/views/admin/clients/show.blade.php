@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.client.show') }}
            </h4>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.client.fields.name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $client->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.client.fields.client_type') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $client->client_type == 'individual' ? 'Individual' : 'Organization' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.client.fields.email_address') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $client->email_address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.client.fields.phone_number') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $client->phone_number ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.client.fields.country') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $client->country->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.client.fields.contact_address') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $client->contact_address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.client.fields.website_address') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $client->website_address ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.client.fields.status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$client->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
