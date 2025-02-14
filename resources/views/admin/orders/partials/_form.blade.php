<div class="row">
    <!-- Order ID (Auto-generated) -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="order_id">{{ trans('cruds.orders.fields.order_id') }}</label>
            <input type="text" id="order_id" name="order_id" class="form-control" value="{{ old('order_id', $order->order_id ?? 'Auto-generated') }}" disabled>
        </div>
    </div>

    <!-- Client -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="client_id">{{ trans('cruds.orders.fields.client') }}<span class="text-danger">*</span></label>
            <select name="client_id" id="client_id" class="form-control select2 {{ $errors->has('client_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.client') }}</option>
                @foreach($clients as $id => $name)
                    <option value="{{ $id }}" {{ old('client_id', $order->client_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('client_id'))
                <span class="text-danger">{{ $errors->first('client_id') }}</span>
            @endif
        </div>
    </div>

    <!-- Service -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="service_id">{{ trans('cruds.orders.fields.service') }}<span class="text-danger">*</span></label>
            <select name="service_id" id="service_id" class="form-control select2 {{ $errors->has('service_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.service') }}</option>
                @foreach($services as $id => $name)
                    <option value="{{ $id }}" {{ old('service_id', $order->service_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('service_id'))
                <span class="text-danger">{{ $errors->first('service_id') }}</span>
            @endif
        </div>
    </div>

    <!-- Input Details -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name_of_subject">{{ trans('cruds.orders.fields.name_of_subject') }}<span class="text-danger">*</span></label>
            <input type="text" id="name_of_subject" name="name_of_subject" class="form-control {{ $errors->has('name_of_subject') ? 'is-invalid' : '' }}" value="{{ old('name_of_subject', $order->name_of_subject ?? '') }}" required>
            @if($errors->has('name_of_subject'))
                <span class="text-danger">{{ $errors->first('name_of_subject') }}</span>
            @endif
        </div>
    </div>

    <!-- Copy of Document to Verify -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="document_to_verify">{{ trans('cruds.orders.fields.document_to_verify') }}<span class="text-danger">*</span></label>
            <input type="file" id="document_to_verify" name="document_to_verify" class="form-control {{ $errors->has('document_to_verify') ? 'is-invalid' : '' }}" accept="application/pdf" required>
            @if($errors->has('document_to_verify'))
                <span class="text-danger">{{ $errors->first('document_to_verify') }}</span>
            @endif
        </div>
    </div>

    <!-- Reason for Request -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="reason_for_request">{{ trans('cruds.orders.fields.reason_for_request') }}<span class="text-danger">*</span></label>
            <select name="reason_for_request" id="reason_for_request" class="form-control select2 {{ $errors->has('reason_for_request') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.reason_for_request') }}</option>
                <option value="Admission" {{ old('reason_for_request', $order->reason_for_request ?? '') == 'Admission' ? 'selected' : '' }}>{{ trans('cruds.orders.fields.reason_for_request_admission') }}</option>
                <option value="Employment" {{ old('reason_for_request', $order->reason_for_request ?? '') == 'Employment' ? 'selected' : '' }}>{{ trans('cruds.orders.fields.reason_for_request_employment') }}</option>
                <option value="Other" {{ old('reason_for_request', $order->reason_for_request ?? '') == 'Other' ? 'selected' : '' }}>{{ trans('cruds.orders.fields.reason_for_request_other') }}</option>
            </select>
            @if($errors->has('reason_for_request'))
                <span class="text-danger">{{ $errors->first('reason_for_request') }}</span>
            @endif
        </div>
    </div>

    <!-- Subject Consent Requirement -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="consent_document">{{ trans('cruds.orders.fields.consent_document') }}<span class="text-danger">*</span></label>
            <input type="file" id="consent_document" name="consent_document" class="form-control {{ $errors->has('consent_document') ? 'is-invalid' : '' }}" accept="application/pdf" required>
            @if($errors->has('consent_document'))
                <span class="text-danger">{{ $errors->first('consent_document') }}</span>
            @endif
        </div>
    </div>

    <!-- Name of Reference Provider -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="reference_provider">{{ trans('cruds.orders.fields.reference_provider') }}<span class="text-danger">*</span></label>
            <input type="text" id="reference_provider" name="reference_provider" class="form-control {{ $errors->has('reference_provider') ? 'is-invalid' : '' }}" value="{{ old('reference_provider', $order->reference_provider ?? '') }}" required>
            @if($errors->has('reference_provider'))
                <span class="text-danger">{{ $errors->first('reference_provider') }}</span>
            @endif
        </div>
    </div>

    <!-- Address Information -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="address_information">{{ trans('cruds.orders.fields.address_information') }}<span class="text-danger">*</span></label>
            <textarea id="address_information" name="address_information" class="form-control {{ $errors->has('address_information') ? 'is-invalid' : '' }}" required>{{ old('address_information', $order->address_information ?? '') }}</textarea>
            @if($errors->has('address_information'))
                <span class="text-danger">{{ $errors->first('address_information') }}</span>
            @endif
        </div>
    </div>

    <!-- Location -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="location_id">{{ trans('cruds.orders.fields.location') }}<span class="text-danger">*</span></label>
            <select name="location_id" id="location_id" class="form-control select2 {{ $errors->has('location_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.location') }}</option>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ old('location_id', $order->location_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('location_id'))
                <span class="text-danger">{{ $errors->first('location_id') }}</span>
            @endif
        </div>
    </div>

    <!-- Gender -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="gender">{{ trans('cruds.orders.fields.gender') }}<span class="text-danger">*</span></label>
            <select name="gender" id="gender" class="form-control select2 {{ $errors->has('gender') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.gender') }}</option>
                <option value="Male" {{ old('gender', $order->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $order->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender', $order->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @if($errors->has('gender'))
                <span class="text-danger">{{ $errors->first('gender') }}</span>
            @endif
        </div>
    </div>

    <!-- Marital Status -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="marital_status">{{ trans('cruds.orders.fields.marital_status') }}<span class="text-danger">*</span></label>
            <select name="marital_status" id="marital_status" class="form-control select2 {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.marital_status') }}</option>
                <option value="Married" {{ old('marital_status', $order->marital_status ?? '') == 'Married' ? 'selected' : '' }}>Married</option>
                <option value="Single" {{ old('marital_status', $order->marital_status ?? '') == 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Other" {{ old('marital_status', $order->marital_status ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @if($errors->has('marital_status'))
                <span class="text-danger">{{ $errors->first('marital_status') }}</span>
            @endif
        </div>
    </div>

    <!-- Registration Number -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="registration_number">{{ trans('cruds.orders.fields.registration_number') }}<span class="text-danger">*</span></label>
            <input type="text" id="registration_number" name="registration_number" class="form-control {{ $errors->has('registration_number') ? 'is-invalid' : '' }}" value="{{ old('registration_number', $order->registration_number ?? '') }}" required>
            @if($errors->has('registration_number'))
                <span class="text-danger">{{ $errors->first('registration_number') }}</span>
            @endif
        </div>
    </div>

    <!-- Others -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="others">{{ trans('cruds.orders.fields.others') }}<span class="text-danger">*</span></label>
            <input type="text" id="others" name="others" class="form-control {{ $errors->has('others') ? 'is-invalid' : '' }}" value="{{ old('others', $order->others ?? '') }}" required>
            @if($errors->has('others'))
                <span class="text-danger">{{ $errors->first('others') }}</span>
            @endif
        </div>
    </div>

    <!-- Preferred Currency -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="preferred_currency">{{ trans('cruds.orders.fields.preferred_currency') }}<span class="text-danger">*</span></label>
            <select name="preferred_currency" id="preferred_currency" class="form-control select2 {{ $errors->has('preferred_currency') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.preferred_currency') }}</option>
                <option value="Service Currency" {{ old('preferred_currency', $order->preferred_currency ?? '') == 'Service Currency' ? 'selected' : '' }}>Service Currency</option>
                <option value="USD" {{ old('preferred_currency', $order->preferred_currency ?? '') == 'USD' ? 'selected' : '' }}>USD</option>
            </select>
            @if($errors->has('preferred_currency'))
                <span class="text-danger">{{ $errors->first('preferred_currency') }}</span>
            @endif
        </div>
    </div>

    <!-- Order Amount -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="order_amount">{{ trans('cruds.orders.fields.order_amount') }}</label>
            <input type="text" id="order_amount" name="order_amount" class="form-control" value="{{ old('order_amount', $order->order_amount ?? $servicePrice) }}" disabled>
        </div>
    </div>

    <!-- Order Payment Status -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="order_payment_status">{{ trans('cruds.orders.fields.order_payment_status') }}</label>
            <select name="order_payment_status" id="order_payment_status" class="form-control select2 {{ $errors->has('order_payment_status') ? 'is-invalid' : '' }}" disabled>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.order_payment_status') }}</option>
                @foreach($paymentStatuses as $id => $status)
                    <option value="{{ $id }}" {{ old('order_payment_status', $order->order_payment_status ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Order Processing Status -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="order_processing_status">{{ trans('cruds.orders.fields.order_processing_status') }}</label>
            <select name="order_processing_status" id="order_processing_status" class="form-control select2 {{ $errors->has('order_processing_status') ? 'is-invalid' : '' }}" disabled>
                <option value="">{{ 'Select ' . trans('cruds.orders.fields.order_processing_status') }}</option>
                @foreach($processingStatuses as $id => $status)
                    <option value="{{ $id }}" {{ old('order_processing_status', $order->order_processing_status ?? '') == $id ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
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

