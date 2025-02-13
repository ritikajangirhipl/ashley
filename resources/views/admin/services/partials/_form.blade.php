<div class="row">
    <!-- Country -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="country_id">{{ trans('cruds.services.fields.country') }}<span class="text-danger">*</span></label>
            <select name="country_id" id="country_id" class="form-control select2 {{ $errors->has('country_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.country') }}</option>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ old('country_id', $service->country_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('country_id'))
                <span class="text-danger">{{ $errors->first('country_id') }}</span>
            @endif
        </div>
    </div>

    <!-- Category -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="category_id">{{ trans('cruds.services.fields.category') }}<span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.category') }}</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ old('category_id', $service->category_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('category_id'))
                <span class="text-danger">{{ $errors->first('category_id') }}</span>
            @endif
        </div>
    </div>

    <!-- Sub Category -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="sub_category_id">{{ trans('cruds.services.fields.sub_category') }}<span class="text-danger">*</span></label>
            <select name="sub_category_id" id="sub_category_id" class="form-control select2 {{ $errors->has('sub_category_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.sub_category') }}</option>
                
                @foreach($subCategories as $id => $name)
                    <option value="{{ $id }}" {{ old('category_id', $service->sub_category_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('sub_category_id'))
                <span class="text-danger">{{ $errors->first('sub_category_id') }}</span>
            @endif
        </div>
    </div>
    
    <!-- Name -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.services.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   value="{{ old('name', $service->name ?? '') }}" required >
            @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <!-- Description -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.services.fields.description') }}<span class="text-danger">*</span></label>
            <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" required>{{ old('description', $service->description ?? '') }}</textarea>
            @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>

    <!-- Subject -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="subject">{{ trans('cruds.services.fields.subject') }}<span class="text-danger">*</span></label>
            <select name="subject" id="subject" class="form-control select2 {{ $errors->has('subject') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.subject') }}</option>
                @foreach($subjects as $id => $name)
                    <option value="{{ $id }}" {{ old('subject', $service->subject ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('subject'))
                <span class="text-danger">{{ $errors->first('subject') }}</span>
            @endif
        </div>
    </div>
    
    <!-- Verification Mode -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="verification_mode_id">{{ trans('cruds.services.fields.verification_mode') }}<span class="text-danger">*</span></label>
            <select name="verification_mode_id" id="verification_mode_id" class="form-control select2 {{ $errors->has('verification_mode_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.verification_mode') }}</option>
                @foreach($verificationModes as $id => $name)
                    <option value="{{ $id }}" {{ old('verification_mode_id', $service->verification_mode_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('verification_mode_id'))
                <span class="text-danger">{{ $errors->first('verification_mode_id') }}</span>
            @endif
        </div>
    </div>


    <!-- verification summary -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="verification_summary">{{ trans('cruds.services.fields.verification_summary') }}<span class="text-danger">*</span></label>
            <input type="text" id="verification_summary" name="verification_summary" class="form-control {{ $errors->has('verification_summary') ? 'is-invalid' : '' }}"
                   value="{{ old('verification_summary', $service->verification_summary ?? '') }}" required >
            @if($errors->has('verification_summary'))
                <span class="text-danger">{{ $errors->first('verification_summary') }}</span>
            @endif
        </div>
    </div>

    <!-- Verification Mode -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="verification_provider_id">{{ trans('cruds.services.fields.verification_provider') }}<span class="text-danger">*</span></label>
            <select name="verification_provider_id" id="verification_provider_id" class="form-control select2 {{ $errors->has('verification_provider_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.verification_provider') }}</option>
                @foreach($verificationModes as $id => $name)
                    <option value="{{ $id }}" {{ old('verification_provider_id', $service->verification_provider_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('verification_provider_id'))
                <span class="text-danger">{{ $errors->first('verification_provider_id') }}</span>
            @endif
        </div>
    </div>

    <!-- verification duration -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="verification_duration">{{ trans('cruds.services.fields.verification_duration') }}<span class="text-danger">*</span></label>
            <input type="text" id="verification_duration" name="verification_duration" class="form-control {{ $errors->has('verification_duration') ? 'is-invalid' : '' }}"
                   value="{{ old('verification_duration', $service->verification_duration ?? '') }}" required >
            @if($errors->has('verification_duration'))
                <span class="text-danger">{{ $errors->first('verification_duration') }}</span>
            @endif
        </div>
    </div>

    <!-- Evidence Type -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="evidence_type_id">{{ trans('cruds.services.fields.evidence_type') }}<span class="text-danger">*</span></label>
            <select name="evidence_type_id" id="evidence_type_id" class="form-control select2 {{ $errors->has('evidence_type_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.evidence_type') }}</option>
                @foreach($evidenceTypes as $id => $name)
                    <option value="{{ $id }}" {{ old('evidence_type_id', $service->evidence_type_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('evidence_type_id'))
                <span class="text-danger">{{ $errors->first('evidence_type_id') }}</span>
            @endif
        </div>
    </div>

    <!-- evidence summary -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="evidence_summary">{{ trans('cruds.services.fields.evidence_summary') }}<span class="text-danger">*</span></label>
            <input type="text" id="evidence_summary" name="evidence_summary" class="form-control {{ $errors->has('evidence_summary') ? 'is-invalid' : '' }}"
                   value="{{ old('evidence_summary', $service->evidence_summary ?? '') }}" required >
            @if($errors->has('evidence_summary'))
                <span class="text-danger">{{ $errors->first('evidence_summary') }}</span>
            @endif
        </div>
    </div>

    <!-- Service Partner -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="service_partner_id">{{ trans('cruds.services.fields.service_partner') }}<span class="text-danger">*</span></label>
            <select name="service_partner_id" id="service_partner_id" class="form-control select2 {{ $errors->has('service_partner_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.service_partner') }}</option>
                @foreach($servicePartners as $id => $name)
                    <option value="{{ $id }}" {{ old('service_partner_id', $service->service_partner_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Service Partner -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="service_currency">{{ trans('cruds.services.fields.service_currency') }}<span class="text-danger">*</span></label>
            <input type="text" id="service_currency" name="service_currency" class="form-control {{ $errors->has('service_currency') ? 'is-invalid' : '' }}"
                   value="{{ old('service_currency', $service->service_currency ?? '') }}" required readonly disable>
            
            @if($errors->has('service_currency'))
                <span class="text-danger">{{ $errors->first('service_currency') }}</span>
            @endif
        </div>
    </div>

    <!-- Local Service Price -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="local_service_price">{{ trans('cruds.services.fields.local_service_price') }}<span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="local_service_price" name="local_service_price" class="form-control {{ $errors->has('local_service_price') ? 'is-invalid' : '' }}"
                   value="{{ old('local_service_price', $service->local_service_price ?? '') }}" required >
            @if($errors->has('local_service_price'))
                <span class="text-danger">{{ $errors->first('local_service_price') }}</span>
            @endif
        </div>
    </div>

    <!-- usd Service Price -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="usd_service_price">{{ trans('cruds.services.fields.usd_service_price') }}<span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="usd_service_price" name="usd_service_price" class="form-control {{ $errors->has('usd_service_price') ? 'is-invalid' : '' }}"
                   value="{{ old('usd_service_price', $service->usd_service_price ?? '') }}" required >
            @if($errors->has('usd_service_price'))
                <span class="text-danger">{{ $errors->first('usd_service_price') }}</span>
            @endif
        </div>
    </div>

    <!-- Input Details -->
    <div class="row m-2">
        <div class="col-md-12 col-sm-12">
            <h4>Input Details</h4>
            <hr>
        </div>
    
        <!-- Name of Subject -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="subject_name">{{ trans('cruds.services.fields.subject_name') }}<span class="text-danger">*</span></label>

                <select name="subject_name" id="subject_name" class="form-control select2 {{ $errors->has('subject_name') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.subject_name') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('subject_name', $service->subject_name ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('subject_name'))
                    <span class="text-danger">{{ $errors->first('subject_name') }}</span>
                @endif
            </div>
        </div>

        <!-- Name of Subject -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="copy_of_document_to_verify">{{ trans('cruds.services.fields.copy_of_document_to_verify') }}<span class="text-danger">*</span></label>

                <select name="copy_of_document_to_verify" id="copy_of_document_to_verify" class="form-control select2 {{ $errors->has('copy_of_document_to_verify') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.copy_of_document_to_verify') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('copy_of_document_to_verify', $service->copy_of_document_to_verify ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('copy_of_document_to_verify'))
                    <span class="text-danger">{{ $errors->first('copy_of_document_to_verify') }}</span>
                @endif
            </div>
        </div>


        <!-- reason for request -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="reason_for_request">{{ trans('cruds.services.fields.reason_for_request') }}<span class="text-danger">*</span></label>
                
                <select name="reason_for_request" id="reason_for_request" class="form-control select2 {{ $errors->has('reason_for_request') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.reason_for_request') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('reason_for_request', $service->reason_for_request ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('reason_for_request'))
                    <span class="text-danger">{{ $errors->first('reason_for_request') }}</span>
                @endif
            </div>
        </div>


        <!-- subject consent requirement -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="subject_consent_requirement">{{ trans('cruds.services.fields.subject_consent_requirement') }}<span class="text-danger">*</span></label>

                <select name="subject_consent_requirement" id="subject_consent_requirement" class="form-control select2 {{ $errors->has('subject_consent_requirement') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.subject_consent_requirement') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('subject_consent_requirement', $service->subject_consent_requirement ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('subject_consent_requirement'))
                    <span class="text-danger">{{ $errors->first('subject_consent_requirement') }}</span>
                @endif
            </div>
        </div>


        <!-- Name of Subject -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="name_of_reference_provider">{{ trans('cruds.services.fields.name_of_reference_provider') }}<span class="text-danger">*</span></label>

                <select name="name_of_reference_provider" id="name_of_reference_provider" class="form-control select2 {{ $errors->has('name_of_reference_provider') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.name_of_reference_provider') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('name_of_reference_provider', $service->name_of_reference_provider ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('name_of_reference_provider'))
                    <span class="text-danger">{{ $errors->first('name_of_reference_provider') }}</span>
                @endif
            </div>
        </div>

        <!-- address_information -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="address_information">{{ trans('cruds.services.fields.address_information') }}<span class="text-danger">*</span></label>

                <select name="address_information" id="address_information" class="form-control select2 {{ $errors->has('address_information') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.address_information') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('address_information', $service->address_information ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('address_information'))
                    <span class="text-danger">{{ $errors->first('address_information') }}</span>
                @endif
            </div>
        </div>


        <!-- location -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="location">{{ trans('cruds.services.fields.location') }}<span class="text-danger">*</span></label>

                <select name="location" id="location" class="form-control select2 {{ $errors->has('location') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.location') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('location', $service->location ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('location'))
                    <span class="text-danger">{{ $errors->first('location') }}</span>
                @endif
            </div>
        </div>

        <!-- gender -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="gender">{{ trans('cruds.services.fields.gender') }}<span class="text-danger">*</span></label>

                <select name="gender" id="gender" class="form-control select2 {{ $errors->has('gender') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.gender') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('gender', $service->gender ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('gender'))
                    <span class="text-danger">{{ $errors->first('gender') }}</span>
                @endif
            </div>
        </div>

        <!-- marital_status -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="marital_status">{{ trans('cruds.services.fields.marital_status') }}<span class="text-danger">*</span></label>

                <select name="marital_status" id="marital_status" class="form-control select2 {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.marital_status') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('marital_status', $service->marital_status ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('marital_status'))
                    <span class="text-danger">{{ $errors->first('marital_status') }}</span>
                @endif
            </div>
        </div>

        <!-- registration_number -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="registration_number">{{ trans('cruds.services.fields.registration_number') }}<span class="text-danger">*</span></label>

                <select name="registration_number" id="registration_number" class="form-control select2 {{ $errors->has('registration_number') ? 'is-invalid' : '' }}" required>
                    <option value="">{{ 'Select ' . trans('cruds.services.fields.registration_number') }}</option>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ old('registration_number', $service->registration_number ?? '') == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('registration_number'))
                    <span class="text-danger">{{ $errors->first('registration_number') }}</span>
                @endif
            </div>
        </div>

        @include('admin.services.partials._additional_fields')
    </div>

    <!-- status -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.services.fields.status') }}<span class="text-danger">*</span></label>

            <select name="status" id="status" class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.services.fields.status') }}</option>
                @foreach($status as $id => $name)
                    <option value="{{ $id }}" {{ old('status', $service->status ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>

            @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>

</div>

<!-- Submit Button -->
<div>
    @if(isset($service))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit"> {{ trans('global.create') }}</button>
    @endif
</div>