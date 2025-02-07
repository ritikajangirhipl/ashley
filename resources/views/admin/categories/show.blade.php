@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.category.show') }}  
        </h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.category.fields.name') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $category->name }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.category.fields.image') }}:</b></h6>
                    @if($category->image)
                        <p class="ml-2 mb-0">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }} Image" class="img-thumbnail" width="150">
                        </p>
                    @else
                        <p class="ml-2 mb-0">No image available</p>
                    @endif
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.category.fields.description') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ $category->description }}</p>
                </div>
                <div class="form-group d-flex view-listing">
                    <h6 class="mb-0"><b>{{ trans('cruds.category.fields.status') }}:</b></h6>
                    <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$category->status) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection