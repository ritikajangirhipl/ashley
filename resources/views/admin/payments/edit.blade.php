@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
        </h4>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="payment-form" action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.payments.partials._form', ['payment' => $payment])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.payment.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection