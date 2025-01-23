@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route("admin.roles.update", [$role->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin/roles/_form')
            </form>


        </div>
    </div>
@endsection
