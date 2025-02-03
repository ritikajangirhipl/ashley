@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.evidence_type.show') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.evidence_type.fields.name') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $evidenceType->name }}</p>
                </div>

                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.evidence_type.fields.description') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $evidenceType->description }}</p>
                </div>

                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.evidence_type.fields.status') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$evidenceType->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection