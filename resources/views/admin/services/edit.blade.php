@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.services.title_singular') }}
        </h4>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="services-form" action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.services.partials._form', ['service' => $service])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.services.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection