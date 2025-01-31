<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.country.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" value="{{ old('name', isset($country) ? $country->name : '') }}" autofocus>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="flag">{{ trans('cruds.country.fields.flag') }}<span class="text-danger">*</span></label>
            <input type="file" id="flag" name="flag" class="form-control {{ $errors->has('flag') ? 'has-error' : '' }}" accept="image/png, image/jpeg, image/jpg, image/svg">
            
            @if(isset($country) && $country->flag)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $country->flag) }}" alt="Country Flag" width="100" height="60">
                </div>
            @endif

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
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="currency_name">{{ trans('cruds.country.fields.currency_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="currency_name" name="currency_name" class="form-control {{ $errors->has('currency_name') ? 'has-error' : '' }}" value="{{ old('currency_name', isset($country) ? $country->currency_name : '') }}">
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
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.country.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ isset($country) && $country->status == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div>
    @if(isset($country))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>