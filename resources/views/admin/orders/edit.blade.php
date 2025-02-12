@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.order.title_singular') }}
        </h4>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="order-form" action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.orders.partials._form', ['order' => $order])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.orders.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection
