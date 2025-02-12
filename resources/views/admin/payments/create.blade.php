@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.payment.title_singular') }}
        </h4>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="payment-form" action="{{ route('admin.payments.store') }}" method="POST">
            @csrf
            @include('admin.payments.partials._form', ['payment' => null])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.payments.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection