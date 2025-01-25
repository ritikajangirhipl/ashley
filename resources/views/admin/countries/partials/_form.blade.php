<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.country.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($country) ? $country->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('flag') ? 'has-error' : '' }}">
            <label for="flag">{{ trans('cruds.country.fields.flag') }}</label>
            <input type="file" id="flag" name="flag" class="form-control">
            @if($errors->has('flag'))
                <p class="help-block">
                    {{ $errors->first('flag') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description">{{ trans('cruds.country.fields.description') }}</label>
            <textarea name="description" class="form-control">{{ old('description', isset($country) ? $country->description : '') }}</textarea>
            @if($errors->has('description'))
                <p class="help-block">
                    {{ $errors->first('description') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('currency_name') ? 'has-error' : '' }}">
            <label for="currency_name">{{ trans('cruds.country.fields.currency_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="currency_name" name="currency_name" class="form-control" value="{{ old('currency_name', isset($country) ? $country->currency_name : '') }}" required>
            @if($errors->has('currency_name'))
                <p class="help-block">
                    {{ $errors->first('currency_name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('currency_symbol') ? 'has-error' : '' }}">
            <label for="currency_symbol">{{ trans('cruds.country.fields.currency_symbol') }}<span class="text-danger">*</span></label>
            <input type="text" id="currency_symbol" name="currency_symbol" class="form-control" value="{{ old('currency_symbol', isset($country) ? $country->currency_symbol : '') }}" required>
            @if($errors->has('currency_symbol'))
                <p class="help-block">
                    {{ $errors->first('currency_symbol') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.country.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($country) ? $country->status : null), ['class' => 'form-control select2', 'id' => 'status', 'placeholder' => 'Select ' . trans('cruds.country.fields.status'), 'required' => 'true']) }}
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