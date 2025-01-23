@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">
                    {{ trans('global.create') }} {{ trans('cruds.role.title_singular') }}
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin/roles/_form')
                </form>
            </div>
        </div>
@endsection
