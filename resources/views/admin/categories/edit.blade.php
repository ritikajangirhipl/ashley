@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.category.edit') }} 
        </h4>
    </div>

    <div class="card-body">
        <form id="categories-form" action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data"
            data-isEdit="{{ isset($category) ? 'true' : 'false' }}"
            data-existing-image="{{ isset($category->image) ? $category->image : '' }}">
            @csrf
            @method('PUT')
            @include('admin.categories.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.categories.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection

