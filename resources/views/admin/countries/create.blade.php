@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.country.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="countries-form" action="{{ route('admin.countries.store') }}" method="POST" enctype="multipart/form-data" data-isEdit="false">
            @csrf
            @include('admin.countries.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.countries.partials._script')
@endsection
