<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.verification_provider.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   value="{{ old('name', $verificationProvider->name ?? '') }}" required autofocus>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.verification_provider.fields.description') }}<span class="text-danger">*</span></label>
            <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">
                {{ old('description', $verificationProvider->description ?? '') }}
            </textarea>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="provider_type_id">{{ trans('cruds.verification_provider.fields.provider_type') }}<span class="text-danger">*</span></label>
            <select name="provider_type_id" id="provider_type_id" class="form-control select2 {{ $errors->has('provider_type_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.verification_provider.fields.provider_type') }}</option>
                @foreach($providerTypes as $id => $name)
                    <option value="{{ $id }}" {{ old('provider_type_id', $verificationProvider->provider_type_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="country_id">{{ trans('cruds.verification_provider.fields.country') }}<span class="text-danger">*</span></label>
            <select name="country_id" id="country_id" class="form-control select2 {{ $errors->has('country_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.verification_provider.fields.country') }}</option>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ old('country_id', $verificationProvider->country_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_address">{{ trans('cruds.verification_provider.fields.contact_address') }}<span class="text-danger">*</span></label>
            <textarea id="contact_address" name="contact_address" class="form-control {{ $errors->has('contact_address') ? 'is-invalid' : '' }}">{{ old('contact_address', $verificationProvider->contact_address ?? '') }}</textarea>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="email">{{ trans('cruds.verification_provider.fields.email_address') }}<span class="text-danger">*</span></label>
            <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email', $verificationProvider->email ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="website">{{ trans('cruds.verification_provider.fields.website') }}<span class="text-danger">*</span></label>
            <input type="url" id="website" name="website" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                   value="{{ old('website', $verificationProvider->website ?? '') }}">
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_person">{{ trans('cruds.verification_provider.fields.contact_person') }}<span class="text-danger">*</span></label>
            <input type="text" id="contact_person" name="contact_person" class="form-control {{ $errors->has('contact_person') ? 'is-invalid' : '' }}"
                   value="{{ old('contact_person', $verificationProvider->contact_person ?? '') }}">
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.verification_provider.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ old('status', $verificationProvider->status ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div>
    @if(isset($verificationProvider))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit"> {{ trans('global.create') }}</button>
    @endif
</div>

