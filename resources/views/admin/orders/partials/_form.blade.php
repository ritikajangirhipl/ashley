<div class="row">
    <!-- Client -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="client_id">{{ trans('cruds.order.fields.client') }}<span class="text-danger">*</span></label>
            <select name="client_id" id="client_id" class="form-control select2" required>
                <option value="">Select Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $order->client_id ?? '') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Service -->
    <div class="col-md-6 col-sm-12">
    <div class="form-group">
        <label for="service_id">{{ trans('cruds.order.fields.service') }}<span class="text-danger">*</span></label>
        <select name="service_id" id="service_id" class="form-control select2" required>
            <option value="">Select Service</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}" {{ old('service_id', $order->service_id ?? '') == $service->id ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>
    <!-- Input Details -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name_subject">{{ trans('cruds.order.fields.name_subject') }}<span class="text-danger">*</span></label>
            <input type="text" id="name_subject" name="name_subject" class="form-control {{ $errors->has('name_subject') ? 'is-invalid' : '' }}" value="{{ old('name_subject', $order->name_subject ?? '') }}" required>
        </div>
    </div>

    <!-- Copy of Document to Verify -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="document_to_verify">{{ trans('cruds.order.fields.document_to_verify') }}<span class="text-danger">*</span></label>
            <input type="file" id="document_to_verify" name="document_to_verify" class="form-control {{ $errors->has('document_to_verify') ? 'is-invalid' : '' }}" accept="application/pdf" required>
        </div>
    </div>

    <!-- Reason for Request -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="reason_for_request">{{ trans('cruds.order.fields.reason_for_request') }}<span class="text-danger">*</span></label>
            <select name="reason_for_request" id="reason_for_request" class="form-control select2 {{ $errors->has('reason_for_request') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.reason_for_request') }}</option>
                <option value="Admission" {{ old('reason_for_request', $order->reason_for_request ?? '') == 'Admission' ? 'selected' : '' }}>{{ trans('cruds.order.fields.reason_for_request_admission') }}</option>
                <option value="Employment" {{ old('reason_for_request', $order->reason_for_request ?? '') == 'Employment' ? 'selected' : '' }}>{{ trans('cruds.order.fields.reason_for_request_employment') }}</option>
                <option value="Other" {{ old('reason_for_request', $order->reason_for_request ?? '') == 'Other' ? 'selected' : '' }}>{{ trans('cruds.order.fields.reason_for_request_other') }}</option>
            </select>
        </div>
    </div>

    <!-- Subject Consent Requirement -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="consent_document">{{ trans('cruds.order.fields.consent_document') }}<span class="text-danger">*</span></label>
            <input type="file" id="consent_document" name="consent_document" class="form-control {{ $errors->has('consent_document') ? 'is-invalid' : '' }}" accept="application/pdf" required>
        </div>
    </div>

    <!-- Name of Reference Provider -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="reference_provider">{{ trans('cruds.order.fields.reference_provider') }}<span class="text-danger">*</span></label>
            <input type="text" id="reference_provider" name="reference_provider" class="form-control {{ $errors->has('reference_provider') ? 'is-invalid' : '' }}" value="{{ old('reference_provider', $order->reference_provider ?? '') }}" required>
        </div>
    </div>

    <!-- Address Information -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="address_information">{{ trans('cruds.order.fields.address_information') }}<span class="text-danger">*</span></label>
            <textarea id="address_information" name="address_information" class="form-control {{ $errors->has('address_information') ? 'is-invalid' : '' }}" required>{{ old('address_information', $order->address_information ?? '') }}</textarea>
        </div>
    </div>

    <!-- Location -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="location_id">{{ trans('cruds.order.fields.location') }}<span class="text-danger">*</span></label>
            <select name="location_id" id="location_id" class="form-control select2 {{ $errors->has('location_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.location') }}</option>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ old('location_id', $order->location_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Gender -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="gender">{{ trans('cruds.order.fields.gender') }}<span class="text-danger">*</span></label>

            <select name="gender" id="gender" class="form-control select2 {{ $errors->has('gender') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.gender') }}</option>
                @foreach($genderOpts as $key => $value)
                    <option value="{{ $key }}" {{ old('gender', $order->gender ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Marital Status -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="marital_status">{{ trans('cruds.order.fields.marital_status') }}<span class="text-danger">*</span></label>

            <select name="marital_status" id="marital_status" class="form-control select2 {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.marital_status') }}</option>
                @foreach($maritalStatusOpts as $key => $value)
                    <option value="{{ $key }}" {{ old('marital_status', $order->marital_status ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>


    <!-- Registration Number -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="registration_number">{{ trans('cruds.order.fields.registration_number') }}<span class="text-danger">*</span></label>
            <input type="text" id="registration_number" name="registration_number" class="form-control {{ $errors->has('registration_number') ? 'is-invalid' : '' }}" value="{{ old('registration_number', $order->registration_number ?? '') }}" required>
        </div>
    </div>

    <!-- Others -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="others">{{ trans('cruds.order.fields.others') }}<span class="text-danger">*</span></label>
            <input type="text" id="others" name="others" class="form-control {{ $errors->has('others') ? 'is-invalid' : '' }}" value="{{ old('others', $order->others ?? '') }}" required>
        </div>
    </div>

    <!-- Preferred Currency -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="preferred_currency">{{ trans('cruds.order.fields.preferred_currency') }}<span class="text-danger">*</span></label>
            <select name="preferred_currency" id="preferred_currency" class="form-control select2 {{ $errors->has('preferred_currency') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.preferred_currency') }}</option>
                <option value="Service Currency" {{ old('preferred_currency', $order->preferred_currency ?? '') == 'Service Currency' ? 'selected' : '' }}>Service Currency</option>
                <option value="USD" {{ old('preferred_currency', $order->preferred_currency ?? '') == 'USD' ? 'selected' : '' }}>USD</option>
            </select>
        </div>
    </div>

    <!-- Order Amount -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="order_amount">{{ trans('cruds.order.fields.order_amount') }}<span class="text-danger">*</span></label>
            <input type="text" id="order_amount" name="order_amount" class="form-control" disabled>
        </div>
    </div>

</div>

<!-- Submit Button -->
<div>
    @if(isset($order))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>

