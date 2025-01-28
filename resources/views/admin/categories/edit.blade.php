@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.categories.update', [$category->CategoryID]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.categories.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@endsection
