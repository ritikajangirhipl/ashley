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
         <form id="verification-modes-form" action="{{ route('admin.verification-modes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.verification-modes.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.verification-modes.partials._script')
@endsection
