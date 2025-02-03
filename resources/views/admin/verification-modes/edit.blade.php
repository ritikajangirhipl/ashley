@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.verification_mode.edit') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="verification-modes-form" action="{{ route('admin.verification-modes.update', $verificationMode->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.verification-modes.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.verification-modes.partials._script')
@endsection