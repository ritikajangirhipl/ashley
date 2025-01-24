@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.sub_category.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.sub-categories.update', $subCategory->SubCategoryID) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.sub-categories.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@endsection