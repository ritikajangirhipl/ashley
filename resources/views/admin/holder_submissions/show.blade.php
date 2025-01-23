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
                    {{ trans('global.show') }} {{ trans('cruds.holder_submissions.title_singular') }}
                </h4>
            </div>
            <div class="card-body">
                @include('admin/holder_submissions/partials/_details')
            </div>            
        </div>
    </div>
</div>
    
@endsection

