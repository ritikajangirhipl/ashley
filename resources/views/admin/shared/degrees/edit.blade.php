@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.'.request()->degreeType.'.title_singular') }} {{ trans('cruds.degrees.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.degrees.update', [request()->degreeType,$degree->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin/shared/degrees/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent
@include('admin/shared/degrees/partials/_script')
@endsection
