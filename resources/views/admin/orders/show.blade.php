@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.order.show') }}
            </h4>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.order_id') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->id }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.client') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->client->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.service') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->service->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.order_amount') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->order_amount ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.order_status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ config('constant.enums.order_status.'.$order->order_status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
