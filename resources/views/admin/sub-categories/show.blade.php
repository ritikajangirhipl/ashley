@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.sub_category.show') }}
        </h4>
        <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.category') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ optional($subCategory->category)->name ?? 'No Category' }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.name') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $subCategory->name }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.image') }}:</b></h6>
                    @if($subCategory->image)
                        <p class="ml-2 mb-0">
                            <img src="{{ asset('storage/' . $subCategory->image) }}" alt="{{ $subCategory->name }} Image" class="img-thumbnail" width="150">
                        </p>
                    @else
                        <p class="ml-2 mb-0">No image available</p>
                    @endif
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.description') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $subCategory->description }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.status') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$subCategory->status) }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.sub_category.fields.created_at') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ date("Y-m-d", strtotime($subCategory->created_at)) ?? __('global.N/A') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
