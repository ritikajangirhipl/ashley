@extends('layouts.admin')
@section('title', trans('panel.page_title.dashboard'))
@section('content')

        <div class="page-header">
          <div class="row">
            <div class="col-lg-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><i data-feather="home"></i><span> Dashboard</span></li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      
@endsection
@section('scripts')
@parent

@endsection