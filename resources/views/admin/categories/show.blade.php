@extends('layouts.admin')
@section('title', $pageTitle)
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/jquery.fancybox.min.css') }}">
@endsection
@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.category.show') }}  
        </h4>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>  
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form_view_outer">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.category.fields.name') }}:</h6>
                        <p>{{ $category->name }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.category.fields.description') }}:</h6>
                        <p>{{ $category->description }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.category.fields.status') }}:</h6>
                        <p>{{ config('constant.enums.status.'.$category->status) }}</p>
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.category.fields.image') }}:</h6>
                        @if($category->image)
                            <p>
                                <a href="{{ asset('storage/' . $category->image) }}" class="upload_data_img" data-fancybox="gallery">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }} Image" class="img-thumbnail" width="150">
                                </a>
                            </p>
                        @else
                            <p>No image available</p>
                        @endif
                    </div>
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0">{{ trans('cruds.category.fields.created_at') }}:</h6>
                        <p>{{ date("Y-m-d", strtotime($category->created_at)) ?? __('global.N/A') }}</p>
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