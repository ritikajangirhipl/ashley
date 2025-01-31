@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.category.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="categories-form" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.categories.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.categories.partials._script')
@endsection

