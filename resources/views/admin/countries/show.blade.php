@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('panel.page_title.country.show') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.country.fields.name') }}</label>
                    <p>{{ $country->name }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.country.fields.description') }}</label>
                    <p>{{ $country->description }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.country.fields.flag') }}</label>
                    <p>
                        @if($country->flag)
                            <img src="{{ asset('storage/' . $country->flag) }}" width="50" height="30" alt="Flag">
                        @else
                            No Flag
                        @endif
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.country.fields.currency_name') }}</label>
                    <p>{{ $country->currency_name }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.country.fields.currency_symbol') }}</label>
                    <p>{{ $country->currency_symbol }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.country.fields.status') }}</label>
                    <p>{{ ucfirst($country->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection