@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('panel.page_title.categories.show') }} 
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.category.fields.name') }}</label>
                    <p>{{ $category->name }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.category.fields.description') }}</label>
                    <p>{{ $category->description }}</p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ trans('cruds.category.fields.status') }}</label>
                    <p>{{ ucfirst($category->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection