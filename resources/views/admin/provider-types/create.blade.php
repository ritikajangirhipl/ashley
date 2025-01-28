@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.provider_type.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="provider-type-form" action="{{ route('admin.provider-types.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.provider-types.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.provider-types.partials._script')
@endsection