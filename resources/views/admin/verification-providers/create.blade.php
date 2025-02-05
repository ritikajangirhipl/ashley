@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.verification_provider.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="verificationProvider-form" action="{{ route('admin.verification-providers.store') }}" method="POST">
            @csrf
            @include('admin.verification-providers.partials._form', ['verificationProvider' => null])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.verification-providers.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection

