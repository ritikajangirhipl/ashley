@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin/users/_form')
        </form>
    </div>
</div>
    
@endsection
