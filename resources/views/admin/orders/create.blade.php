@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.order.title_singular') }}
        </h4>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="order-form" action="{{ route('admin.orders.store') }}" method="POST">
            @csrf
            @include('admin.orders.partials._form', ['order' => null])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.orders.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection
