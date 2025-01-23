@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.students.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="bill-verify-payments" action="{{ route('admin.students.update', [$student->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            @include('admin/students/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent
@include('admin/students/partials/_script')
@endsection
