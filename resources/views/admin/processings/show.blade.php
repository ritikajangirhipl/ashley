@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.processing.show') }}
            </h4>
            <a href="{{ route('admin.processings.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.processing.fields.order_id') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ 'Order #' . $processing->order_id }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.processing.fields.status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $processing->status }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.processing.fields.verification_outcome') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $processing->verification_outcome ?? __('global.N/A') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.processing.fields.outcome_evidence') }}:</b></h6>
                        <p class="ml-2 mb-0">
                            @if($processing->outcome_evidence)
                                <a href="{{ Storage::url($processing->outcome_evidence) }}" target="_blank">{{ trans('global.view_file') }}</a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
