@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('panel.page_title.verification_provider.show') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.verification_provider.fields.name') }}</label>
                    <p>{{ $Verificationprovider->name }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.verification_provider.fields.description') }}</label>
                    <p>{{ $Verificationprovider->description }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.verification_provider.fields.status') }}</label>
                    <p>{{ ucfirst($Verificationprovider->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection