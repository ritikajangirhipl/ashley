@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.client.title_singular') }}
        </h4>
        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card-body">
        <form id="client-form" action="{{ route('admin.clients.store') }}" method="POST">
            @csrf
            @include('admin.clients.partials._form', ['client' => null])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.clients.partials._script')
<script>
    var isEditPage = false;
</script>
<script src="{{ asset('js/common.js') }}"></script>
@endsection

