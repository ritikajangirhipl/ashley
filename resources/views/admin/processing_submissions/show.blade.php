@extends('layouts.admin')
@section('title', $pageTitle)

@section('styles')

<!-- Smart Wizard css -->
<link rel="stylesheet" href="{{ asset('assets/admin/js/smart-wizard/css/smart_wizard.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/js/smart-wizard/css/smart_wizard_theme_dots.min.css') }}">

@endsection

@section('content')

<div class="page-wrapper" style="min-height: 284px;">
    <div class="content container-fluid">
        <div class="card mb-0">
            <div class="card-header card-header-primary">
                <h4 class="card-title">
                    {{ trans('global.show') }} {{ trans('cruds.processing_submissions.title_singular') }}
                </h4>
            </div>
            <div class="card-body">
                @include('admin/holder_submissions/partials/_details')
            </div>
            <div class="card-body pt-0">
                <form id="submission-step-form" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin/processing_submissions/partials/_submission_steps_form')
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('scripts')
@parent
<script src="{{ asset('assets/admin/js/smart-wizard/js/jquery.smartWizard.min.js') }}" defer></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

@include('admin/processing_submissions/partials/_stepper_script')

@endsection
