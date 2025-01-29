@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.country.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="countries-form" action="{{ route('admin.countries.update', $country->CountryID) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.countries.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.countries.partials._script')
@endsection