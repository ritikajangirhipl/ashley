@extends('layouts.admin')
@section('title', $pageTitle)
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/jquery.fancybox.min.css') }}">
@endsection
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ __('panel.page_title.category.add') }} 
        </h4>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>  
    </div>

    <div class="card-body">
        <form id="categories-form" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.categories.partials._form')
        </form>
    </div>
</div>

@endsection

@section('scripts')
@parent
@include('admin.categories.partials._script')
<script src="{{ asset('js/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/admin/js/jquery.fancybox.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-fancybox="gallery"]').fancybox({
            loop: false
        });
    });    
</script>
@endsection

