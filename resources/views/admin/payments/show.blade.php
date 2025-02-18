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
                <div class="col-md-12">
                    <div class="form_view_outer">
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.payment.fields.order_id') }}:</h6>
                            <p>{{ $payment->order->id ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.payment.fields.reference_number') }}:</h6>
                            <p>{{ $payment->reference_number ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.payment.fields.evidence') }}:</h6>
                            <p>
                                @if($payment->evidence)
                                    <a class="btn btn-sm btn-secondary" href="{{ asset('storage/' . $payment->evidence) }}" target="_blank">{{ trans('global.view') }} PDF</a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.payment.fields.status') }}:</h6>
                            <p>
                                {{ config('constant.enums.payment_status.'.$payment->status, __('global.N/A')) }}
                            </p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.payment.fields.amount') }}:</h6>
                            <p>{{ number_format($payment->amount, 2) }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.payment.fields.currency') }}:</h6>
                            <p>{{ strtoupper($payment->currency) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
