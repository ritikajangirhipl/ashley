@csrf
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name">{{ trans('cruds.country.fields.name') }}<span class="required">*</span></label>
    <input type="text" id="name" name="name" class="form-control name" value="{{ old('name', isset($country) ? $country->name : '') }}" required autofocus>
    @if($errors->has('name'))
        <p class="help-block">
            {{ $errors->first('name') }}
        </p>
    @endif
</div>
<div>
    <input class="btn btn-info" id="saveButton" type="submit" value="{{ trans('global.save') }}">
</div> 
