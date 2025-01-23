@csrf
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name">{{ trans('cruds.accreditation_bodies.fields.name') }}<span class="required">*</span></label>
    <input type="text" id="name" name="name" class="form-control name" value="{{ old('name', isset($accreditationBody) ? $accreditationBody->name : '') }}" required>
    @if($errors->has('name'))
        <p class="help-block">
            {{ $errors->first('name') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
    <label for="name">{{ trans('cruds.accreditation_bodies.fields.country_id') }}<span class="required">*</span></label>
    {{ Form::select('country_id', $countries, old('country_id', isset($accreditationBody) ? $accreditationBody->country_id : null), ['class' => 'form-control country_id','id'=>'country_id','placeholder'=>'Select Country','required'=>'true']) }}
    
    @if($errors->has('country_id'))
        <p class="help-block">
            {{ $errors->first('country_id') }}
        </p>
    @endif
</div>

<div>
    <input class="btn btn-info" id="saveButton" type="submit" value="{{ trans('global.save') }}">
</div> 
