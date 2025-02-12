@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.verification_provider.title_singular') }}
        </h4>
        <a href="{{ route('admin.verification-providers.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="verificationProvider-form" action="{{ route('admin.verification-providers.update', $verificationProvider->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.verification-providers.partials._form', ['verificationProvider' => $verificationProvider])
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.verification-providers.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection