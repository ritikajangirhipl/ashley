@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.provider_type.edit') }}
        </h4>
    </div>

    <div class="card-body">
         <form id="provider-type-form" action="{{ route('admin.provider-types.update', [$providerType->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.provider-types.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.provider-types.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection