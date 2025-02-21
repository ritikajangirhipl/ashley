@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">
                {{ __('panel.page_title.service.show') }}
            </h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form_view_outer mb-5 service-view">
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.country') }}:</h6>
                            <p>{{ ucwords($service->country->name) ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.category') }}:</h6>
                            <p>{{ ucwords($service->category->name) ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.sub_category') }}:</h6>
                            <p>{{ ucwords($service->subCategory->name) ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.name') }}:</h6>
                            <p>{{ $service->name }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.description') }}:</h6>
                            <p>{{ $service->description ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.subject') }}:</h6>
                            <p>{{ $subjects[$service->subject] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.verification_mode') }}:</h6>
                            <p>{{ $service->verificationMode->name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.verification_summary') }}:</h6>
                            <p>{{ $service->verification_summary ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.verification_provider') }}:</h6>
                            <p>{{ $service->verificationProvider->name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.verification_duration') }}:</h6>
                            <p>{{ $service->verification_duration ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.evidence_type') }}:</h6>
                            <p>{{ $service->evidenceType->name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.evidence_summary') }}:</h6>
                            <p>{{ $service->evidence_summary ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.service_partner') }}:</h6>
                            <p>{{ $service->servicePartner->name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.service_currency') }}:</h6>
                            <p>{{ $service->country->currency_name ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.local_service_price') }}:</h6>
                            <p>{{ $service->local_service_price ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.usd_service_price') }}:</h6>
                            <p>{{ $service->usd_service_price ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.subject_name') }}:</h6>
                            <p>{{ $input_details[$service->subject_name] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.copy_of_document_to_verify') }}:</h6>
                            <p>{{ $input_details[$service->copy_of_document_to_verify] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.reason_for_request') }}:</h6>
                            <p>{{ $input_details[$service->reason_for_request] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.subject_consent_requirement') }}:</h6>
                            <p>{{ $input_details[$service->subject_consent_requirement] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.name_of_reference_provider') }}:</h6>
                            <p>{{ $input_details[$service->name_of_reference_provider] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.address_information') }}:</h6>
                            <p>{{ $input_details[$service->address_information] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.location') }}:</h6>
                            <p>{{ $input_details[$service->location] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.gender') }}:</h6>
                            <p>{{ $input_details[$service->gender] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.marital_status') }}:</h6>
                            <p>{{ $input_details[$service->marital_status] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.registration_number') }}:</h6>
                            <p>{{ $input_details[$service->registration_number] ?? __('global.N/A') }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.status') }}:</h6>
                            <p>{{ config('constant.enums.status.'.$service->status) }}</p>
                        </div>
                        <div class="form-group d-flex view-listing">
                            <h6 class="mb-0">{{ trans('cruds.services.fields.created_at') }}:</h6>
                            <p>{{ date("Y-m-d", strtotime($service->created_at)) ?? __('global.N/A') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h4 class="mb-3"><b>Additional Field Information</b></h4>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>{{ trans('cruds.services.fields.field_name') }}</th>
                                <th>{{ trans('cruds.services.fields.field_type') }}</th>
                                <th>{{ trans('cruds.services.fields.combo_values') }}</th>
                                <th>{{ trans('cruds.services.fields.field_required') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($service->additionalFields as $key => $field)
                            <tr>
                                <td>{{ $field->field_name ?? "" }}</td>
                                <td>{{ $field_types[$field->field_type] ?? "" }}</td>
                                <td>{{ $field->combo_values ? $field->combo_values : "-" }}</td>
                                <td>{{ $input_details[$field->field_required] ?? "" }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection