@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.payment.show') }}
            </h4>
            <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Back</a>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.payment.fields.order_id') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $payment->order->id ?? __('global.N/A') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.payment.fields.reference_number') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $payment->reference_number ?? __('global.N/A') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.payment.fields.evidence') }}:</b></h6>
                        <p class="ml-2 mb-0">
                            @if($payment->evidence)
                                <a href="{{ asset('storage/' . $payment->evidence) }}" target="_blank">{{ trans('global.view') }} PDF</a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.payment.fields.status') }}:</b></h6>
                        <p class="ml-2 mb-0">
                            {{ config('constant.enums.payment_status.'.$payment->status, __('global.N/A')) }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.payment.fields.amount') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ number_format($payment->amount, 2) }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.payment.fields.currency') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ strtoupper($payment->currency) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
