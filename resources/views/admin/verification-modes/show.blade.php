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
            <div class="col-md-6">
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.verification_mode.fields.name') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $verificationMode->name }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                     <h6 class="mb-0"><b>{{ trans('cruds.verification_mode.fields.description') }}:</b></h6>
                     <p class="ml-2 mb-0">{{ $verificationMode->description }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.verification_mode.fields.status') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$verificationMode->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection