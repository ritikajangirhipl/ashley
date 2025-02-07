<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.client.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   value="{{ old('name', $client->name ?? '') }}" required autofocus>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="client_type">{{ trans('cruds.client.fields.client_type') }}<span class="text-danger">*</span></label>
            <select name="client_type" id="client_type" class="form-control select2 {{ $errors->has('client_type') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.client.fields.client_type') }}</option>
                @foreach($clientTypes as $key => $type)
                    <option value="{{ $key }}" {{ old('client_type', $client->client_type ?? '') == $key ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="email_address">{{ trans('cruds.client.fields.email_address') }}<span class="text-danger">*</span></label>
            <input type="email" id="email_address" name="email_address" class="form-control {{ $errors->has('email_address') ? 'is-invalid' : '' }}"
                value="{{ old('email_address', $client->email_address ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="phone_number">{{ trans('cruds.client.fields.phone_number') }}<span class="text-danger">*</span></label>
            <input type="text" id="phone_number" name="phone_number" class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                   value="{{ old('phone_number', $client->phone_number ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="country_id">{{ trans('cruds.client.fields.country') }}<span class="text-danger">*</span></label>
            <select name="country_id" id="country_id" class="form-control select2 {{ $errors->has('country_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.client.fields.country') }}</option>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ old('country_id', $client->country_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_address">{{ trans('cruds.client.fields.contact_address') }}<span class="text-danger">*</span></label>
            <textarea id="contact_address" name="contact_address" class="form-control {{ $errors->has('contact_address') ? 'is-invalid' : '' }}">{{ old('contact_address', $client->contact_address ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="website_address">{{ trans('cruds.client.fields.website_address') }}<span class="text-danger">*</span></label>
            <input type="url" id="website_address" name="website_address" class="form-control {{ $errors->has('website_address') ? 'is-invalid' : '' }}" value="{{ old('website_address', $client->website_address ?? '') }}">
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="password">{{ trans('cruds.client.fields.password') }}<span class="text-danger">*</span></label>
            <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" required>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.client.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ old('status', $client->status ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div>
    @if(isset($client))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>
