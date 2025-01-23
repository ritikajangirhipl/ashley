@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.holder_submissions.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="holder-submissions" action="{{ route('admin.holder-submissions.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @include('admin/holder_submissions/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent

@include('admin/holder_submissions/partials/_script')

<script type="text/javascript">
    $(document).ready( function(){
      $('.dropify').dropify();
    });
</script>
@endsection


