@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.evaluation_templates.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.evaluation-templates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin/evaluation_templates/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent
@include('admin/evaluation_templates/partials/_script')
@endsection