@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.sub_category.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.sub-categories.store') }}" method="POST">
            @csrf
            @include('admin.sub-categories.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@endsection