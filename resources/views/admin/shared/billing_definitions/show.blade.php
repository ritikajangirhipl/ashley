@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.'.request()->billingType.'.title_singular') }} {{ trans('cruds.billing_definitions.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.billing_definitions.fields.'.request()->billingType.'_id') }}
                        </th>
                        <td>
                            {{ $billingDefinition->billable->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billing_definitions.fields.degree_id') }}
                        </th>
                        <td>
                            {{ $billingDefinition->degree->qualification ?? '' }}
                        </td>
                    </tr>
                    @if(request()->billingType == "receiver")
                    <tr>
                        <th>
                            {{ trans('cruds.billing_definitions.fields.receiver_fees') }}
                        </th>
                        <td>
                            {{ $billingDefinition->receiver_fees ?? '' }}
                        </td>
                    </tr>
                    @else
                        <tr>
                            <th>
                                {{ trans('cruds.billing_definitions.fields.evaluation_fees') }}
                            </th>
                            <td>
                                {{ $billingDefinition->evaluation_fees ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.billing_definitions.fields.translation_fees') }}
                            </th>
                            <td>
                                {{ $billingDefinition->translation_fees ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.billing_definitions.fields.verification_fees') }}
                            </th>
                            <td>
                                {{ $billingDefinition->verification_fees ?? '' }}
                            </td>
                        </tr>
                        
                    @endif
                    <tr>
                        <th>
                            {{ trans('cruds.billing_definitions.fields.other_fees') }}
                        </th>
                        <td>
                            {{ $billingDefinition->other_fees ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billing_definitions.fields.total_fees') }}
                        </th>
                        <td>
                            {{ $billingDefinition->total_fees ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.billing_definitions.fields.status') }}
                        </th>
                        <td>
                            {{ ucwords($billingDefinition->status ?? '') }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-primary" href="{{ route('admin.billing-definitions.index',request()->billingType) }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
    
@endsection
