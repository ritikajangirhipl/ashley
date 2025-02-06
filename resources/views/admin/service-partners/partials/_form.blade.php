<div class="row">
    <!-- Name -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.service_partner.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                   value="{{ old('name', $servicePartner->name ?? '') }}" required autofocus>
            @if($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

    <!-- Description -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.service_partner.fields.description') }}<span class="text-danger">*</span></label>
            <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" required>{{ old('description', $servicePartner->description ?? '') }}</textarea>
            @if($errors->has('description'))
                <span class="text-danger">{{ $errors->first('description') }}</span>
            @endif
        </div>
    </div>

    <!-- Country -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="country_id">{{ trans('cruds.service_partner.fields.country') }}<span class="text-danger">*</span></label>
            <select name="country_id" id="country_id" class="form-control select2 {{ $errors->has('country_id') ? 'is-invalid' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.service_partner.fields.country') }}</option>
                @foreach($countries as $id => $name)
                    <option value="{{ $id }}" {{ old('country_id', $servicePartner->country_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('country_id'))
                <span class="text-danger">{{ $errors->first('country_id') }}</span>
            @endif
        </div>
    </div>

    <!-- Contact Address -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_address">{{ trans('cruds.service_partner.fields.contact_address') }}<span class="text-danger">*</span></label>
            <textarea id="contact_address" name="contact_address" class="form-control {{ $errors->has('contact_address') ? 'is-invalid' : '' }}">{{ old('contact_address', $servicePartner->contact_address ?? '') }}</textarea>
            @if($errors->has('contact_address'))
                <span class="text-danger">{{ $errors->first('contact_address') }}</span>
            @endif
        </div>
    </div>

    <!-- Email Address -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="email_address">{{ trans('cruds.service_partner.fields.email_address') }}<span class="text-danger">*</span></label>
            <input type="email" id="email_address" name="email_address" class="form-control {{ $errors->has('email_address') ? 'is-invalid' : '' }}"
                value="{{ old('email_address', $servicePartner->email_address ?? '') }}" required>
            @if($errors->has('email_address'))
                <span class="text-danger">{{ $errors->first('email_address') }}</span>
            @endif
        </div>
    </div>

    <!-- Website Address -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="website">{{ trans('cruds.service_partner.fields.website') }}<span class="text-danger">*</span></label>
            <input type="url" id="website" name="website" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}"
                   value="{{ old('website', $servicePartner->website ?? '') }}">
            @if($errors->has('website'))
                <span class="text-danger">{{ $errors->first('website') }}</span>
            @endif
        </div>
    </div>

    <!-- Contact Person -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_person">{{ trans('cruds.service_partner.fields.contact_person') }}<span class="text-danger">*</span></label>
            <input type="text" id="contact_person" name="contact_person" class="form-control {{ $errors->has('contact_person') ? 'is-invalid' : '' }}"
                   value="{{ old('contact_person', $servicePartner->contact_person ?? '') }}">
            @if($errors->has('contact_person'))
                <span class="text-danger">{{ $errors->first('contact_person') }}</span>
            @endif
        </div>
    </div>

    <!-- Status -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.service_partner.fields.status') }}<span class="text-danger">*</span></label>
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

<!-- Submit Button -->
<div>
    @if(isset($servicePartner))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit"> {{ trans('global.create') }}</button>
    @endif
</div>