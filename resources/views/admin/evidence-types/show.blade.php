@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('panel.page_title.evidence_type.show') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.evidence_type.fields.name') }}</label>
                    <p>{{ $evidenceType->name }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.evidence_type.fields.description') }}</label>
                    <p>{{ $evidenceType->description }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.evidence_type.fields.status') }}</label>
                    <p>{{ ucfirst($evidenceType->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection