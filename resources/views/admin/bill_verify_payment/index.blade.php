@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title float-left">
                    {{ trans('cruds.bill_verify_payments.title') }} {{ trans('global.list') }}
                </h4>
            </div>

            <div class="card-block">
                <div class="table-responsive">
                    <div class="clearfix"></div>
                    {{ $dataTable->table(['class' => 'display table nowrap table-hover', 'style' => 'width:100%;']) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
{!! $dataTable->scripts() !!}

@endsection

