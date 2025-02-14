@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.verification_mode.show') }}
        </h4>
        <a href="{{ route('admin.verification-modes.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form_view_outer">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.verification_mode.fields.name') }}:</h6>
                        <p>{{ $verificationMode->name }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.verification_mode.fields.description') }}:</h6>
                        <p>{{ $verificationMode->description }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.verification_mode.fields.status') }}:</h6>
                        <p>{{ config('constant.enums.status.'.$verificationMode->status) }}</p>
                    </div>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.verification_mode.fields.created_at') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ date("Y-m-d", strtotime($verificationMode->created_at)) ?? __('global.N/A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection