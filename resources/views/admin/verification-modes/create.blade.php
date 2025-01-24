@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.verification_mode.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.verification-modes.store') }}" method="POST">
            @csrf
            @include('admin.verification-modes.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@endsection