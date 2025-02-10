<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.service_partners.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}"
                   value="{{ old('name', $servicePartner->name ?? '') }}" required autofocus>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.service_partners.fields.description') }}<span class="text-danger">*</span></label>
            <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" required>{{ old('description', $servicePartner->description ?? '') }}</textarea>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="country_id">{{ trans('cruds.service_partners.fields.country') }}<span class="text-danger">*</span></label>
            <select name="country_id" id="country_id" class="form-control select2 {{ $errors->has('country_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.service_partners.fields.country') }}</option>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ old('country_id', $servicePartner->country_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_address">{{ trans('cruds.service_partners.fields.contact_address') }}<span class="text-danger">*</span></label>
            <textarea id="contact_address" name="contact_address" class="form-control {{ $errors->has('contact_address') ? 'has-error' : '' }}">{{ old('contact_address', $servicePartner->contact_address ?? '') }}</textarea>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="email_address">{{ trans('cruds.service_partners.fields.email_address') }}<span class="text-danger">*</span></label>
            <input type="email" id="email_address" name="email_address" class="form-control {{ $errors->has('email_address') ? 'has-error' : '' }}"
                value="{{ old('email_address', $servicePartner->email_address ?? '') }}" required>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="website_address">{{ trans('cruds.service_partners.fields.website_address') }}<span class="text-danger">*</span></label>
            <input type="url" id="website_address" name="website_address" class="form-control {{ $errors->has('website_address') ? 'has-error' : '' }}"
                   value="{{ old('website_address', $servicePartner->website_address ?? '') }}">
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_person">{{ trans('cruds.service_partners.fields.contact_person') }}<span class="text-danger">*</span></label>
            <input type="text" id="contact_person" name="contact_person" class="form-control {{ $errors->has('contact_person') ? 'has-error' : '' }}"
                   value="{{ old('contact_person', $servicePartner->contact_person ?? '') }}">
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.service_partners.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ old('status', $servicePartner->status ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('status'))
                <span class="text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>
    </div>
</div>
<div>
    @if(isset($servicePartner))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit"> {{ trans('global.create') }}</button>
    @endif
</div>