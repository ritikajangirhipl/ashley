@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
        {{ trans('panel.page_title.sub_category.show') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <strong>{{ trans('cruds.sub_category.fields.category') }}:</strong>
                <p>{{ $subCategory->category->name }}</p>
            </div>

            <div class="col-md-6">
                <strong>{{ trans('cruds.sub_category.fields.name') }}:</strong>
                <p>{{ $subCategory->name }}</p>
            </div>

            <div class="col-md-6">
                <strong>{{ trans('cruds.sub_category.fields.description') }}:</strong>
                <p>{{ $subCategory->description }}</p>
            </div>

            <div class="col-md-6">
                <strong>{{ trans('cruds.sub_category.fields.status') }}:</strong>
                <p>{{ ucfirst($subCategory->status) }}</p>
            </div>
        </div>
    </div>
</div>

@endsection