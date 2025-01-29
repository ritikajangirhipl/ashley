<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.country.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" value="{{ old('name', isset($country) ? $country->name : '') }}" autofocus>
            @if($errors->has('name'))
                <p class="help-block text-danger">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="flag">{{ trans('cruds.country.fields.flag') }}<span class="text-danger">*</span></label>
            <input type="file" id="flag" name="flag" class="form-control {{ $errors->has('flag') ? 'has-error' : '' }}" accept="image/png, image/jpeg, image/jpg, image/svg">
            @if($errors->has('flag'))
                <p class="help-block text-danger">
                    {{ $errors->first('flag') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.country.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}">{{ old('description', isset($country) ? $country->description : '') }}</textarea>
            @if($errors->has('description'))
                <p class="help-block text-danger">
                    {{ $errors->first('description') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="currency_name">{{ trans('cruds.country.fields.currency_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="currency_name" name="currency_name" class="form-control {{ $errors->has('currency_name') ? 'has-error' : '' }}" value="{{ old('currency_name', isset($country) ? $country->currency_name : '') }}">
            @if($errors->has('currency_name'))
                <p class="help-block text-danger">
                    {{ $errors->first('currency_name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="currency_symbol">{{ trans('cruds.country.fields.currency_symbol') }}<span class="text-danger">*</span></label>
            <input 
                type="text" 
                id="currency_symbol" 
                name="currency_symbol" 
                class="form-control  {{ $errors->has('currency_symbol') ? 'has-error' : '' }}" 
                value="{{ old('currency_symbol', isset($country) ? $country->currency_symbol : '') }}" 
                pattern="[\p{Sc}\p{So}]*" 
                title="Only valid currency symbols (e.g., $, €, £, ¥) are allowed. Numbers, letters, and spaces are not allowed." 
                required
            >
            @if($errors->has('currency_symbol'))
                <p class="help-block text-danger">
                    {{ $errors->first('currency_symbol') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.country.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($country) ? $country->status : null), ['class' => 'form-control select2'.($errors->has('status') ? 'has-error' : ''), 'id' => 'status', 'placeholder' => 'Select ' . trans('cruds.country.fields.status'), 'required' => 'false']) }}
            @if($errors->has('status'))
                <p class="help-block text-danger">
                    {{ $errors->first('status') }}
                </p>
            @endif
        </div>
    </div>
</div>

<div>
    @if(isset($country))
        <input class="btn btn-info" type="submit" value="{{ trans('global.update') }}">
    @else
        <input class="btn btn-info" type="submit" value="{{ trans('global.create') }}">
    @endif
</div>