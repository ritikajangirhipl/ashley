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
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.subject_name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->subject_name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.document') }}:</b></h6>
                        <p class="ml-2 mb-0">
                            @if($order->document)
                                <a href="{{ Storage::url('documents/'.$order->document) }}" target="_blank">{{ trans('global.view') }}</a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.reason') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucfirst($order->reason) ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.subject_consent') }}:</b></h6>
                        <p class="ml-2 mb-0">
                            @if($order->subject_consent)
                                <a href="{{ Storage::url('consents/'.$order->subject_consent) }}" target="_blank">{{ trans('global.view') }}</a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.reference_provider_name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->reference_provider_name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.address_information') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->address_information ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.location') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->location->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.gender') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucfirst($order->gender) ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.payment_status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->paymentStatus->name ?? 'N/A' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.order.fields.processing_status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $order->processingStatus->name ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
