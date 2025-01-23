@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.create') }} {{ trans('cruds.bill_verify_payments.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <form id="bill-verify-payments" action="{{ route('admin.submissionStage.bill-verify-payments.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @include('admin/bill_verify_payment/partials/_form')
        </form>
    </div>
</div>
    
@endsection

@section('scripts')
@parent
@include('admin/bill_verify_payment/partials/_script')
@endsection


