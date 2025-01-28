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
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.category') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $subCategory->category->name }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.name') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $subCategory->name }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.description') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $subCategory->description }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.status') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ ucfirst($subCategory->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection