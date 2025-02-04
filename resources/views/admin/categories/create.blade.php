@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.category.add') }} 
        </h4>
    </div>

    <div class="card-body">
        <form id="categories-form" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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

