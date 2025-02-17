<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.country.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ isset($country) ? $country->name : '' }}" autofocus>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="currency_name">{{ trans('cruds.country.fields.currency_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="currency_name" name="currency_name" class="form-control" value="{{ isset($country) ? $country->currency_name : '' }}">
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <div class="choose-image">
                <div>
                    <label for="flag">{{ trans('cruds.country.fields.flag') }}<span class="text-danger">*</span></label>
                    <input type="file" id="flagInput" name="flag" class="form-control" accept="image/png, image/jpeg, image/jpg, image/svg">
                </div>
                @isset($country)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $country->flag) }}" data-fancybox="gallery">
                            <img id="flagPreview"
                                src="{{ asset('storage/' . $country->flag) }}"
                                alt="Country Flag"
                                width="100"
                                height="60"
                                class="img-thumbnail">
                        </a>
                    </div>
                @endisset
                <div class="mt-2">
                    <a id="newFlagPreviewLink" href="#" data-fancybox="gallery" style="display: none;">
                        <img id="newFlagPreview" src="#" alt="Flag Preview" class="img-thumbnail" width="100" height="60" style="display: none;">
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="currency_symbol">{{ trans('cruds.country.fields.currency_symbol') }}<span class="text-danger">*</span></label>
            <input type="text" id="currency_symbol" name="currency_symbol" class="form-control" value="{{ isset($country) ? $country->currency_symbol : '' }}" required>
        </div>
    </div>    

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.country.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control">{{ isset($country) ? $country->description : '' }}</textarea>
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
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.country.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}">{{ old('description', isset($country) ? $country->description : '') }}</textarea>
        </div>
    </div>
</div>
<div>
    <button class="btn btn-info" type="submit">{{ (isset($country)) ? trans('global.update') : trans('global.create') }}</button>
</div>