@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('panel.page_title.provider_type.show') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.provider_type.fields.name') }}</label>
                    <p>{{ $providerType->name }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.provider_type.fields.description') }}</label>
                    <p>{{ $providerType->description }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.provider_type.fields.status') }}</label>
                    <p>{{ ucfirst($providerType->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection