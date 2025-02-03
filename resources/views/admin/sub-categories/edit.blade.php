@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.sub_category.edit') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="sub-categories-form" action="{{ route('admin.sub-categories.update', $subCategory->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.sub-categories.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.sub-categories.partials._script')
@endsection