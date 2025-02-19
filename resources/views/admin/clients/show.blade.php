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
                <div class="col-md-12">
                    <div class="form_view_outer">
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.name') }}:</h6>
                            <p>{{ $client->name }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.client_type') }}:</h6>
                            <p>{{ $client->client_type == 'individual' ? 'Individual' : 'Organization' }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.email') }}:</h6>
                            <p>{{ $client->email ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.phone_number') }}:</h6>
                            <p>{{ $client->phone_number ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.country') }}:</h6>
                            <p>{{ $client->country->name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.contact_address') }}:</h6>
                            <p>{{ $client->contact_address ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.website_address') }}:</h6>
                            <p>{{ $client->website_address ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.status') }}:</h6>
                            <p>{{ config('constant.enums.status.'.$client->status) }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.client.fields.created_at') }}:</h6>
                            <p>{{ date("Y-m-d", strtotime($client->created_at)) ?? __('global.N/A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
