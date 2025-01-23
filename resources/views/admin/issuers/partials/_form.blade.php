<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.issuer.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($issuer) ? $issuer->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('initial') ? 'has-error' : '' }}">
            <label for="initial">{{ trans('cruds.issuer.fields.initial') }}<span class="text-danger">*</span></label>
            <input type="text" id="initial" name="initial" class="form-control" value="{{ old('initial', isset($issuer) ? $issuer->initial : '') }}" required>
            @if($errors->has('initial'))
                <p class="help-block">
                    {{ $errors->first('initial') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
            <label for="country_id">{{ trans('cruds.issuer.fields.country_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('country_id', $countries, old('country_id', isset($issuer) ? $issuer->country_id : null), ['class' => 'form-control select2 country_id','id'=>'country_id','placeholder'=>trans('cruds.issuer.fields.select_country_id'),'required'=>'true']) }}

            @if($errors->has('country_id'))
                <p class="help-block">
                    {{ $errors->first('country_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
            <label for="type">{{ trans('cruds.issuer.fields.type') }}<span class="text-danger">*</span></label>
            {{ Form::select('type', $issuerType, old('type', isset($issuer) ? $issuer->type : null), ['class' => 'form-control select2 type','id'=>'type','placeholder'=>'Select '.trans('cruds.issuer.fields.type'),'required'=>'true']) }}

            @if($errors->has('type'))
                <p class="help-block">
                    {{ $errors->first('type') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('recognition_status') ? 'has-error' : '' }}">
            <label for="recognition_status">{{ trans('cruds.issuer.fields.recognition_status') }}<span class="text-danger">*</span></label>
            {{ Form::select('recognition_status', $recognitionStatus, old('recognition_status', isset($issuer) ? $issuer->recognition_status : null), ['class' => 'form-control select2 type','id'=>'recognition_status','placeholder'=>'Select '.trans('cruds.issuer.fields.recognition_status'),'required'=>'true']) }}

            @if($errors->has('recognition_status'))
                <p class="help-block">
                    {{ $errors->first('recognition_status') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('accreditation_status') ? 'has-error' : '' }}">
            <label for="accreditation_status">{{ trans('cruds.issuer.fields.accreditation_status') }}<span class="text-danger">*</span></label>
            {{ Form::select('accreditation_status', $accreditationStatus, old('accreditation_status', isset($issuer) ? $issuer->accreditation_status : null), ['class' => 'form-control select2 type','id'=>'accreditation_status','placeholder'=>'Select '.trans('cruds.issuer.fields.accreditation_status'),'required'=>'true']) }}

            @if($errors->has('accreditation_status'))
                <p class="help-block">
                    {{ $errors->first('accreditation_status') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('accreditation_body_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.issuer.fields.accreditation_body_id') }}<span class="required">*</span></label>
            {!! Form::select('accreditation_body_id',[''=>'Select accreditation body'],null,['class'=>'form-control select2 accreditation_body_id', 'id'=>'accreditation_body_id','required'=>'true','data-selected'=>isset($issuer) ? $issuer->accreditation_body_id : ""]) !!}
            
            @if($errors->has('accreditation_body_id'))
                <p class="help-block">
                    {{ $errors->first('accreditation_body_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('website_url') ? 'has-error' : '' }}">
            <label for="website_url">{{ trans('cruds.issuer.fields.website_url') }}<span class="text-danger">*</span></label>
            <input type="text" id="website_url" name="website_url" class="form-control" value="{{ old('website_url', isset($issuer) ? $issuer->website_url : '') }}" required>
            @if($errors->has('website_url'))
                <p class="help-block">
                    {{ $errors->first('website_url') }}
                </p>
            @endif
        </div>
    </div>


    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">{{ trans('cruds.issuer.fields.email') }}<span class="text-danger">*</span></label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($issuer) ? $issuer->email : '') }}" required>
            @if($errors->has('email'))
                <p class="help-block">
                    {{ $errors->first('email') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
            <label for="address">{{ trans('cruds.issuer.fields.address') }}<span class="text-danger">*</span></label>
            <input type="text" id="address" name="address" class="form-control" value="{{ old('address', isset($issuer) ? $issuer->address : '') }}" required>
            @if($errors->has('address'))
                <p class="help-block">
                    {{ $errors->first('address') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
            <label for="contact_name">{{ trans('cruds.issuer.fields.contact_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="contact_name" name="contact_name" class="form-control" value="{{ old('contact_name', isset($issuer) ? $issuer->contact_name : '') }}" required>
            @if($errors->has('contact_name'))
                <p class="help-block">
                    {{ $errors->first('contact_name') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
            <label for="contact_number">{{ trans('cruds.issuer.fields.contact_number') }}<span class="text-danger">*</span></label>
            <input type="text" id="contact_number" name="contact_number" class="form-control" value="{{ old('contact_number', isset($issuer) ? $issuer->contact_number : '') }}" required>
            @if($errors->has('contact_number'))
                <p class="help-block">
                    {{ $errors->first('contact_number') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
            <label for="contact_email">{{ trans('cruds.issuer.fields.contact_email') }}<span class="text-danger">*</span></label>
            <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{ old('contact_email', isset($issuer) ? $issuer->contact_email : '') }}" required>
            @if($errors->has('contact_email'))
                <p class="help-block">
                    {{ $errors->first('contact_email') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.issuer.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($issuer) ? $issuer->status : null), ['class' => 'form-control select2 type','id'=>'status','placeholder'=>'Select '.trans('cruds.issuer.fields.status'),'required'=>'true']) }}

            @if($errors->has('status'))
                <p class="help-block">
                    {{ $errors->first('status') }}
                </p>
            @endif
        </div>
    </div>

</div>

<div>
    <input class="btn btn-info" type="submit" value="{{ trans('global.save') }}">
</div>