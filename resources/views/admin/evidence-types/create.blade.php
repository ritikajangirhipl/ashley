@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.evidence_type.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.evidence-types.store') }}" method="POST">
            @csrf
            @include('admin.evidence-types.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@endsection