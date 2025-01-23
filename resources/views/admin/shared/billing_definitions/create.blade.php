@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.'.request()->billingType.'.title_singular') }} {{ trans('cruds.billing_definitions.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.billing-definitions.store',request()->billingType) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin/shared/billing_definitions/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent

@include('admin/shared/billing_definitions/partials/_script')

@endsection