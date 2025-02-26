@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.verification_mode.add') }}
        </h4>
        <a href="{{ route('admin.verification-modes.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
         <form id="verification-modes-form" action="{{ route('admin.verification-modes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.verification-modes.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.verification-modes.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection
