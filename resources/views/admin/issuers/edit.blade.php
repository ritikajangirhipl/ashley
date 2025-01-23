@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.issuer.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.issuers.update', [$issuer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin/issuers/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent
@include('admin/issuers/partials/_script')
@endsection
