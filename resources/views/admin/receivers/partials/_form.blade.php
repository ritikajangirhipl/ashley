<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.receiver.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($receiver) ? $receiver->name : '') }}" required>
            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>


    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('initial') ? 'has-error' : '' }}">
            <label for="initial">{{ trans('cruds.receiver.fields.initial') }}<span class="text-danger">*</span></label>
            <input type="text" id="initial" name="initial" class="form-control" value="{{ old('initial', isset($receiver) ? $receiver->initial : '') }}" required>
            @if($errors->has('initial'))
                <p class="help-block">
                    {{ $errors->first('initial') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
            <label for="country_id">{{ trans('cruds.receiver.fields.country_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('country_id', $countries, old('country_id', isset($receiver) ? $receiver->country_id : null), ['class' => 'form-control select2 country_id','id'=>'country_id','placeholder'=>trans('cruds.receiver.fields.select_country_id'),'required'=>'true']) }}

            @if($errors->has('country_id'))
                <p class="help-block">
                    {{ $errors->first('country_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('website_url') ? 'has-error' : '' }}">
            <label for="website_url">{{ trans('cruds.receiver.fields.website_url') }}<span class="text-danger">*</span></label>
            <input type="text" id="website_url" name="website_url" class="form-control" value="{{ old('website_url', isset($receiver) ? $receiver->website_url : '') }}" required>
            @if($errors->has('website_url'))
                <p class="help-block">
                    {{ $errors->first('website_url') }}
                </p>
            @endif
        </div>
    </div>


    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">{{ trans('cruds.receiver.fields.email') }}<span class="text-danger">*</span></label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($receiver) ? $receiver->email : '') }}" required>
            @if($errors->has('email'))
                <p class="help-block">
                    {{ $errors->first('email') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">{{ trans('cruds.receiver.fields.password') }}<span class="text-danger">*</span></label>
            <input type="password" id="password" name="password" class="form-control" value="{{ old('password', isset($receiver) ? $receiver->password : '') }}" required>
            @if($errors->has('password'))
                <p class="help-block">
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
            <label for="contact_name">{{ trans('cruds.receiver.fields.contact_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="contact_name" name="contact_name" class="form-control" value="{{ old('contact_name', isset($receiver) ? $receiver->contact_name : '') }}" required>
            @if($errors->has('contact_name'))
                <p class="help-block">
                    {{ $errors->first('contact_name') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('contact_number') ? 'has-error' : '' }}">
            <label for="contact_number">{{ trans('cruds.receiver.fields.contact_number') }}<span class="text-danger">*</span></label>
            <input type="text" id="contact_number" name="contact_number" class="form-control" value="{{ old('contact_number', isset($receiver) ? $receiver->contact_number : '') }}" required>
            @if($errors->has('contact_number'))
                <p class="help-block">
                    {{ $errors->first('contact_number') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
            <label for="contact_email">{{ trans('cruds.receiver.fields.contact_email') }}<span class="text-danger">*</span></label>
            <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{ old('contact_email', isset($receiver) ? $receiver->contact_email : '') }}" required>
            @if($errors->has('contact_email'))
                <p class="help-block">
                    {{ $errors->first('contact_email') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.receiver.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($receiver) ? $receiver->status : null), ['class' => 'form-control select2 type','id'=>'status','placeholder'=>'Select '.trans('cruds.receiver.fields.status'),'required'=>'true']) }}

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