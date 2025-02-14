@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.order.show') }}
            </h4>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Client -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.client') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucwords($order->client->name) ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Service -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.service') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->service->name ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Country -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.country') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucwords($order->country->name) ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Category -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.category') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucwords($order->category->name) ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Sub Category -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.sub_category') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucwords($order->subCategory->name) ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Reason for Request -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.reason_for_request') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$order->reason_for_request] ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Name of Subject -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.subject_name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$order->subject_name] ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Address Information -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.address_information') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->address_information ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Order Amount -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.order_amount') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->order_amount ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Order Payment Status -->
                <!-- <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.orders.fields.order_payment_status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->orderPaymentStatus->name ?? 'N/A' }}</p>
                    </div>
                </div> -->

                <!-- Order Processing Status -->
                <!-- <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.orders.fields.order_processing_status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->orderProcessingStatus->name ?? 'N/A' }}</p>
                    </div>
                </div> -->

                <!-- Gender -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.gender') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$order->gender] ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Marital Status -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.marital_status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$order->marital_status] ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Registration Number -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.registration_number') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->registration_number ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ config('constant.enums.status.' . $order->status) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

