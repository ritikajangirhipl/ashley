@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.processing.add') }} 
        </h4>
        <a href="{{ route('admin.processings.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="processing-form" action="{{ route('admin.processings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.processings.partials._form', ['processing' => null, 'orders' => $orders, 'status' => $status])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.processings.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection
