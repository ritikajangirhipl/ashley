<!-- <div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="provider_id">{{ trans('cruds.verification_provider.fields.provider_id') }}</label>
            <input type="text" id="provider_id" name="provider_id" class="form-control {{ $errors->has('provider_id') ? 'is-invalid' : '' }}" value="{{ old('provider_id', isset($provider) ? $provider->provider_id : '') }}" readonly>
            @if($errors->has('provider_id'))
                <p class="help-block text-danger">
                    {{ $errors->first('provider_id') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.verification_provider.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', isset($provider) ? $provider->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block text-danger">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.verification_provider.fields.description') }}</label>
            <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}">{{ old('description', isset($provider) ? $provider->description : '') }}</textarea>
            @if($errors->has('description'))
                <p class="help-block text-danger">
                    {{ $errors->first('description') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="provider_type_id">{{ trans('cruds.verification_provider.fields.provider_type') }}<span class="text-danger">*</span></label>
            {{ Form::select('provider_type_id', $providerTypes, old('provider_type_id', isset($provider) ? $provider->provider_type_id : null), ['class' => 'form-control select2']) }}
            @if($errors->has('provider_type_id'))
                <p class="help-block text-danger">
                    {{ $errors->first('provider_type_id') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="provider_type_id">{{ trans('cruds.verification_provider.fields.provider_type') }}<span class="text-danger">*</span></label>
            {{ Form::select('provider_type_id', $providerTypes, old('provider_type_id', isset($provider) ? $provider->provider_type_id : null), ['class' => 'form-control select2 ' . ($errors->has('provider_type_id') ? 'is-invalid' : ''), 'placeholder' => 'Select ' . trans('cruds.verification_provider.fields.provider_type'), 'required' => true]) }}
            @if($errors->has('provider_type_id'))
                <p class="help-block text-danger">
                    {{ $errors->first('provider_type_id') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_address">{{ trans('cruds.verification_provider.fields.contact_address') }}</label>
            <textarea id="contact_address" name="contact_address" class="form-control {{ $errors->has('contact_address') ? 'is-invalid' : '' }}">{{ old('contact_address', isset($provider) ? $provider->contact_address : '') }}</textarea>
            @if($errors->has('contact_address'))
                <p class="help-block text-danger">
                    {{ $errors->first('contact_address') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="email">{{ trans('cruds.verification_provider.fields.email_address') }}<span class="text-danger">*</span></label>
            <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', isset($provider) ? $provider->email : '') }}" required>
            @if($errors->has('email'))
                <p class="help-block text-danger">
                    {{ $errors->first('email') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="website">{{ trans('cruds.verification_provider.fields.website') }}</label>
            <input type="url" id="website" name="website" class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" value="{{ old('website', isset($provider) ? $provider->website : '') }}">
            @if($errors->has('website'))
                <p class="help-block text-danger">
                    {{ $errors->first('website') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="contact_person">{{ trans('cruds.verification_provider.fields.contact_person') }}</label>
            <input type="text" id="contact_person" name="contact_person" class="form-control {{ $errors->has('contact_person') ? 'is-invalid' : '' }}" value="{{ old('contact_person', isset($provider) ? $provider->contact_person : '') }}">
            @if($errors->has('contact_person'))
                <p class="help-block text-danger">
                    {{ $errors->first('contact_person') }}
                </p>
            @endif
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.verification_provider.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], old('status', isset($provider) ? $provider->status : null), ['class' => 'form-control select2 ' . ($errors->has('status') ? 'is-invalid' : ''), 'placeholder' => 'Select Status', 'required' => true]) }}
            @if($errors->has('status'))
                <p class="help-block text-danger">
                    {{ $errors->first('status') }}
                </p>
            @endif
        </div>
    </div>
</div>
<div>
    @if(isset($verificationProvider))
        <input class="btn btn-info" type="submit" value="{{ trans('global.update') }}">
    @else
        <input class="btn btn-info" type="submit" value="{{ trans('global.create') }}">
    @endif
</div> -->
