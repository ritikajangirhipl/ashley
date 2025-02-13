<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="client_id">{{ trans('cruds.order.fields.client') }}<span class="text-danger">*</span></label>
            <select name="client_id" id="client_id" class="form-control select2 {{ $errors->has('client_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.client') }}</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id', $order->client_id ?? '') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="service_id">{{ trans('cruds.order.fields.service') }}<span class="text-danger">*</span></label>
            <select name="service_id" id="service_id" class="form-control select2 {{ $errors->has('service_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.service') }}</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $order->service_id ?? '') == $service->id ? 'selected' : '' }}>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="subject_name">{{ trans('cruds.order.fields.subject_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="subject_name" name="subject_name" class="form-control {{ $errors->has('subject_name') ? 'has-error' : '' }}" value="{{ old('subject_name', $order->subject_name ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="document">{{ trans('cruds.order.fields.document') }}<span class="text-danger">*</span></label>
            <input type="file" id="document" name="document" class="form-control {{ $errors->has('document') ? 'has-error' : '' }}" accept=".pdf">
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="reason">{{ trans('cruds.order.fields.reason') }}<span class="text-danger">*</span></label>
            <select name="reason" id="reason" class="form-control {{ $errors->has('reason') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.reason') }}</option>
                <option value="admission" {{ old('reason', $order->reason ?? '') == 'admission' ? 'selected' : '' }}>{{ trans('cruds.order.fields.reason_admission') }}</option>
                <option value="employment" {{ old('reason', $order->reason ?? '') == 'employment' ? 'selected' : '' }}>{{ trans('cruds.order.fields.reason_employment') }}</option>
                <option value="other" {{ old('reason', $order->reason ?? '') == 'other' ? 'selected' : '' }}>{{ trans('cruds.order.fields.reason_other') }}</option>
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="subject_consent">{{ trans('cruds.order.fields.subject_consent') }}<span class="text-danger">*</span></label>
            <input type="file" id="subject_consent" name="subject_consent" class="form-control {{ $errors->has('subject_consent') ? 'has-error' : '' }}" accept=".pdf">
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="reference_provider_name">{{ trans('cruds.order.fields.reference_provider_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="reference_provider_name" name="reference_provider_name" class="form-control {{ $errors->has('reference_provider_name') ? 'has-error' : '' }}" value="{{ old('reference_provider_name', $order->reference_provider_name ?? '') }}">
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="address_information">{{ trans('cruds.order.fields.address_information') }}<span class="text-danger">*</span></label>
            <textarea id="address_information" name="address_information" class="form-control {{ $errors->has('address_information') ? 'has-error' : '' }}">{{ old('address_information', $order->address_information ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="location">{{ trans('cruds.order.fields.location') }}<span class="text-danger">*</span></label>
            <select name="location" id="location" class="form-control select2 {{ $errors->has('location') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.location') }}</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ old('location', $order->location ?? '') == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="gender">{{ trans('cruds.order.fields.gender') }}<span class="text-danger">*</span></label>
            <select name="gender" id="gender" class="form-control {{ $errors->has('gender') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.gender') }}</option>
                <option value="male" {{ old('gender', $order->gender ?? '') == 'male' ? 'selected' : '' }}>{{ trans('cruds.order.fields.male') }}</option>
                <option value="female" {{ old('gender', $order->gender ?? '') == 'female' ? 'selected' : '' }}>{{ trans('cruds.order.fields.female') }}</option>
                <option value="other" {{ old('gender', $order->gender ?? '') == 'other' ? 'selected' : '' }}>{{ trans('cruds.order.fields.other') }}</option>
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="payment_status">{{ trans('cruds.order.fields.payment_status') }}<span class="text-danger">*</span></label>
            <select name="payment_status" id="payment_status" class="form-control select2 {{ $errors->has('payment_status') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.payment_status') }}</option>
                @foreach($paymentStatus as $status)
                    <option value="{{ $status->id }}" {{ old('payment_status', $order->payment_status ?? '') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="processing_status">{{ trans('cruds.order.fields.processing_status') }}<span class="text-danger">*</span></label>
            <select name="processing_status" id="processing_status" class="form-control select2 {{ $errors->has('processing_status') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.processing_status') }}</option>
                @foreach($processingStatus as $status)
                    <option value="{{ $status->id }}" {{ old('processing_status', $order->processing_status ?? '') == $status->id ? 'selected' : '' }}>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div>
    @if(isset($order))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>

