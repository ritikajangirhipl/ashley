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
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.country') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucwords($service->country->name) ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.category') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucwords($service->category->name) ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.sub_category') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ ucwords($service->subCategory->name) ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->name }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.description') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->description ?? __('global.N/A') }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.subject') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $subjects[$service->subject] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.verification_mode') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->verificationMode->name ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.verification_summary') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->verification_summary ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.verification_provider') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->verificationProvider->name ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.verification_duration') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->verification_duration ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.evidence_type') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->evidenceType->name ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.evidence_summary') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->evidence_summary ?? __('global.N/A') }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.service_partner') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->servicePartner->name ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.service_currency') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->country->currency_name ?? __('global.N/A') }}</p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.local_service_price') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->local_service_price ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.usd_service_price') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $service->usd_service_price ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.subject_name') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->subject_name] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.copy_of_document_to_verify') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->copy_of_document_to_verify] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.reason_for_request') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->reason_for_request] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.subject_consent_requirement') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->subject_consent_requirement] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.name_of_reference_provider') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->name_of_reference_provider] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.address_information') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->address_information] ?? __('global.N/A') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.location') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->location] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.gender') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->gender] ?? __('global.N/A') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.marital_status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->marital_status] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.registration_number') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ $input_details[$service->registration_number] ?? __('global.N/A') }}</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <h3 class="mb-3">Additional Field Information</h3>
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

                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.status') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ config('constant.enums.status.'.$service->status) }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex view-listing">
                        <h6 class="mb-0"><b>{{ trans('cruds.services.fields.created_at') }}:</b></h6>
                        <p class="ml-2 mb-0">{{ date("Y-m-d", strtotime($service->created_at)) ?? __('global.N/A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection