@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.service_partners.title_singular') }}
        </h4>
        <a href="{{ route('admin.service-partners.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="servicePartner-form" action="{{ route('admin.service-partners.store') }}" method="POST">
            @csrf
            @include('admin.service-partners.partials._form', ['servicePartner' => null])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.service-partners.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection