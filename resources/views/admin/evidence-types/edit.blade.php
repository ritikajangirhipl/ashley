@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.evidence_type.edit') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="evidence-type-form" action="{{ route('admin.evidence-types.update', $evidenceType->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.evidence-types.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.evidence-types.partials._script') 
@endsection


