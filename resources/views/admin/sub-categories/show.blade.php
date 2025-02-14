@extends('layouts.admin')
@section('title', $pageTitle)
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/jquery.fancybox.min.css') }}">
@endsection
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
            <div class="col-md-12">
                <div class="form_view_outer">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.sub_category.fields.category') }}:</h6>
                        <p>{{ optional($subCategory->category)->name ?? 'No Category' }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.sub_category.fields.name') }}:</h6>
                        <p>{{ $subCategory->name }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.sub_category.fields.description') }}:</h6>
                        <p>{{ $subCategory->description }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.sub_category.fields.image') }}:</h6>
                        @if($subCategory->image)
                            <p>
                                <a href="{{ asset('storage/' . $subCategory->image) }}" class="upload_data_img" data-fancybox="gallery">
                                    <img src="{{ asset('storage/' . $subCategory->image) }}" alt="{{ $subCategory->name }} Image" class="img-thumbnail" width="150">
                                </a>
                            </p>
                        @else
                            <p>No image available</p>
                        @endif
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.sub_category.fields.status') }}:</h6>
                        <p>{{ config('constant.enums.status.'.$subCategory->status) }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.sub_category.fields.created_at') }}:</h6>
                        <p>{{ date("Y-m-d", strtotime($subCategory->created_at)) ?? __('global.N/A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script type="text/javascript" src="{{ asset('assets/admin/js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-fancybox="gallery"]').fancybox({
            loop: false
        });
    });    
</script>
@endsection