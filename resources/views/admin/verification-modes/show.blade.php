@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('panel.page_title.verification_mode.show') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.verification_mode.fields.name') }}</label>
                    <p>{{ $verificationMode->name }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.verification_mode.fields.description') }}</label>
                    <p>{{ $verificationMode->description }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.verification_mode.fields.status') }}</label>
                    <p>{{ ucfirst($verificationMode->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection