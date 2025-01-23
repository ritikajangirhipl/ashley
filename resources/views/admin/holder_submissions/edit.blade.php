@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.edit') }} {{ trans('cruds.holder_submissions.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="holder-submissions" action="{{ route('admin.holder-submissions.update', [$holderSubmission->id]) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
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

        $("#o_level_certificate").next(".dropify-clear").on('click', function() {
            $('#o_level_certificate_removed').val('1');
            $('#o_level_certificate').attr('required', true);
        });

        $("#degree_certificate").next(".dropify-clear").on('click', function() {
            $('#degree_certificate_removed').val('1');
            $('#degree_certificate').attr('required', true);
        });

        $("#academic_transcripts").next(".dropify-clear").on('click', function() {
            $('#academic_transcripts_removed').val('1');
            $('#academic_transcripts').attr('required', true);
        });

        $("#receiver_letter").next(".dropify-clear").on('click', function() {
            $('#receiver_letter_removed').val('1');
            $('#receiver_letter').attr('required', true);
        });

        $("#ministry_of_education_letter").next(".dropify-clear").on('click', function() {
            $('#ministry_of_education_letter_removed').val('1');
            $('#ministry_of_education_letter').attr('required', true);
        });

        $("#birth_certificate").next(".dropify-clear").on('click', function() {
            $('#birth_certificate_removed').val('1');
            $('#birth_certificate').attr('required', true);
        });
    });
</script>
@endsection
