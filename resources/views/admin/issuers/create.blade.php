@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.issuer.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.issuers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin/issuers/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent
@include('admin/issuers/partials/_script')
@endsection
