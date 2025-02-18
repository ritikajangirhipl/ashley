<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.client.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ isset($client) ? $client->name : '' }}" required autofocus>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="client_type">{{ trans('cruds.client.fields.client_type') }}<span class="text-danger">*</span></label>
            <select name="client_type" id="client_type" class="form-control select2" required>
                <option value="">{{ 'Select ' . trans('cruds.client.fields.client_type') }}</option>
                @foreach($clientTypes as $key => $type)
                    <option value="{{ $key }}" {{ isset($client) && $client->client_type == $key ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="email_address">{{ trans('cruds.client.fields.email_address') }}<span class="text-danger">*</span></label>
            <input type="email" id="email_address" name="email_address" class="form-control" value="{{ isset($client) ? $client->email_address : '' }}" required>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="phone_number">{{ trans('cruds.client.fields.phone_number') }}<span class="text-danger">*</span></label>
            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ isset($client) ? $client->phone_number : '' }}" required>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="country_id">{{ trans('cruds.client.fields.country') }}<span class="text-danger">*</span></label>
            <select name="country_id" id="country_id" class="form-control select2 {{ $errors->has('country_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.client.fields.country') }}</option>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ isset($client) && $client->country_id == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="website_address">{{ trans('cruds.client.fields.website_address') }}<span class="text-danger">*</span></label>
            <input type="url" id="website_address" name="website_address" class="form-control" value="{{ isset($client) ? $client->website_address : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="password">{{ trans('cruds.client.fields.password') }}<span class="text-danger">*</span></label>
            <input type="password" id="password" name="password" class="form-control" value="{{ isset($client) ? $client->password : '' }}" required>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.client.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ isset($client) && $client->status == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <label for="contact_address">{{ trans('cruds.client.fields.contact_address') }}<span class="text-danger">*</span></label>
            <textarea id="contact_address" name="contact_address" class="form-control">{{ isset($client) ? $client->contact_address : '' }}</textarea>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-info" type="submit">{{ (isset($client)) ? trans('global.update') : trans('global.create') }}</button>
</div>
