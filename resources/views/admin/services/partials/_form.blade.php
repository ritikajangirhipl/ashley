<div class="row">
    <!-- Country -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="country_id">{{ trans('cruds.services.fields.country') }}<span class="text-danger">*</span></label>
            <select name="country_id" id="country_id" class="form-control select2" required>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) && $service->country_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Category -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="category_id">{{ trans('cruds.services.fields.category') }}<span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-control select2" required>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) &&  $service->category_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Sub Category -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="sub_category_id">{{ trans('cruds.services.fields.sub_category') }}<span class="text-danger">*</span></label>
            <select name="sub_category_id" id="sub_category_id" class="form-control select2" required>
                @foreach($subCategories as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) &&  $service->sub_category_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    
    <!-- Name -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.services.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control"value="{{ isset($service) ? $service->name : '' }}" required >
        </div>
    </div>

    <!-- Subject -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="subject">{{ trans('cruds.services.fields.subject') }}<span class="text-danger">*</span></label>
            <select name="subject" id="subject" class="form-control select2" required>
                @foreach($subjects as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) &&  $service->subject == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    
    <!-- Verification Mode -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="verification_mode_id">{{ trans('cruds.services.fields.verification_mode') }}<span class="text-danger">*</span></label>
            <select name="verification_mode_id" id="verification_mode_id" class="form-control select2" required>
                @foreach($verificationModes as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) &&  $service->verification_mode_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    <!-- verification summary -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="verification_summary">{{ trans('cruds.services.fields.verification_summary') }}<span class="text-danger">*</span></label>
            <input type="text" id="verification_summary" name="verification_summary" class="form-control" value="{{ isset($service) ? $service->verification_summary : '' }}" required >
        </div>
    </div>

    <!-- Verification Mode -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="verification_provider_id">{{ trans('cruds.services.fields.verification_provider') }}<span class="text-danger">*</span></label>
            <select name="verification_provider_id" id="verification_provider_id" class="form-control select2" required>
                @foreach($verificationModes as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) &&  $service->verification_provider_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- verification duration -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="verification_duration">{{ trans('cruds.services.fields.verification_duration') }}<span class="text-danger">*</span></label>
            <input type="text" id="verification_duration" name="verification_duration" class="form-control" value="{{ isset($service) ? $service->verification_duration : '' }}" required >
        </div>
    </div>

    <!-- Evidence Type -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="evidence_type_id">{{ trans('cruds.services.fields.evidence_type') }}<span class="text-danger">*</span></label>
            <select name="evidence_type_id" id="evidence_type_id" class="form-control select2" required>
                @foreach($evidenceTypes as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) &&  $service->evidence_type_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- evidence summary -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="evidence_summary">{{ trans('cruds.services.fields.evidence_summary') }}<span class="text-danger">*</span></label>
            <input type="text" id="evidence_summary" name="evidence_summary" class="form-control" value="{{ isset($service) ? $service->evidence_summary : '' }}" required >
        </div>
    </div>

    <!-- Service Partner -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="service_partner_id">{{ trans('cruds.services.fields.service_partner') }}<span class="text-danger">*</span></label>
            <select name="service_partner_id" id="service_partner_id" class="form-control select2" required>
                @foreach($servicePartners as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) &&  $service->service_partner_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Service Partner -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="service_currency">{{ trans('cruds.services.fields.service_currency') }}<span class="text-danger">*</span></label>
            <input type="text" id="service_currency" name="service_currency" class="form-control" value="{{ isset($service) ? $service->service_currency : '' }}" required readonly disable>
        </div>
    </div>

    <!-- Local Service Price -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="local_service_price">{{ trans('cruds.services.fields.local_service_price') }}<span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="local_service_price" name="local_service_price" class="form-control" value="{{ isset($service) ? $service->local_service_price : '' }}" required >
        </div>
    </div>

    <!-- usd Service Price -->
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="usd_service_price">{{ trans('cruds.services.fields.usd_service_price') }}<span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="usd_service_price" name="usd_service_price" class="form-control" value="{{ isset($service) ? $service->usd_service_price : '' }}" required >
        </div>
    </div>

    <!-- Description -->
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.services.fields.description') }}<span class="text-danger">*</span></label>
            <textarea id="description" name="description" class="form-control" required>{{ isset($service) ? $service->description : '' }}</textarea>
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
                <select name="subject_name" id="subject_name" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->subject_name == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Name of Subject -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="copy_of_document_to_verify">{{ trans('cruds.services.fields.copy_of_document_to_verify') }}<span class="text-danger">*</span></label>
                <select name="copy_of_document_to_verify" id="copy_of_document_to_verify" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->copy_of_document_to_verify == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- reason for request -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="reason_for_request">{{ trans('cruds.services.fields.reason_for_request') }}<span class="text-danger">*</span></label>
                <select name="reason_for_request" id="reason_for_request" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->reason_for_request == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- subject consent requirement -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="subject_consent_requirement">{{ trans('cruds.services.fields.subject_consent_requirement') }}<span class="text-danger">*</span></label>
                <select name="subject_consent_requirement" id="subject_consent_requirement" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->subject_consent_requirement == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- Name of Subject -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="name_of_reference_provider">{{ trans('cruds.services.fields.name_of_reference_provider') }}<span class="text-danger">*</span></label>
                <select name="name_of_reference_provider" id="name_of_reference_provider" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}"  {{ isset($service) &&  $service->name_of_reference_provider == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- address_information -->
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="address_information">{{ trans('cruds.services.fields.address_information') }}<span class="text-danger">*</span></label>
                <select name="address_information" id="address_information" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->address_information == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <!-- location -->
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label for="location">{{ trans('cruds.services.fields.location') }}<span class="text-danger">*</span></label>
                <select name="location" id="location" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->location == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- gender -->
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label for="gender">{{ trans('cruds.services.fields.gender') }}<span class="text-danger">*</span></label>
                <select name="gender" id="gender" class="form-control select2 {{ $errors->has('gender') ? 'is-invalid' : '' }}" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->gender == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- marital_status -->
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label for="marital_status">{{ trans('cruds.services.fields.marital_status') }}<span class="text-danger">*</span></label>
                <select name="marital_status" id="marital_status" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->marital_status == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- registration_number -->
        <div class="col-md-6 col-sm-12">
            <div class="form-group">
                <label for="registration_number">{{ trans('cruds.services.fields.registration_number') }}<span class="text-danger">*</span></label>
                <select name="registration_number" id="registration_number" class="form-control select2" required>
                    @foreach($inputDetailsOpts as $id => $name)
                        <option value="{{ $id }}" {{ isset($service) &&  $service->registration_number == $id ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @include('admin.services.partials._additional_fields')
    </div>

    <!-- status -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.services.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control select2 {{ $errors->has('status') ? 'is-invalid' : '' }}" required>
                @foreach($status as $id => $name)
                    <option value="{{ $id }}" {{ isset($service) &&  $service->status == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

</div>

<!-- Submit Button -->
<div>
    <button class="btn btn-info" type="submit">{{ (isset($service)) ? trans('global.update') : trans('global.create') }}</button>
</div>