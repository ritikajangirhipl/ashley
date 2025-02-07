@extends('layouts.admin')

@section('title', $pageTitle)

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="client-form" action="{{ route('admin.clients.update', $client->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.clients.partials._form', ['client' => $client])
        </form>
    </div>
</div>
@endsection

@section('scripts')
@parent
@include('admin.clients.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
@endsection
