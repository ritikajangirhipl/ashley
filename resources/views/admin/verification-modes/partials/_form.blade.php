<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.verification_mode.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ isset($verificationMode) ? $verificationMode->name : '' }}" required autofocus>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.verification_mode.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" required>{{ isset($verificationMode) ? $verificationMode->description : '' }}</textarea>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.verification_mode.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ isset($verificationMode) && $verificationMode->status == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-info" type="submit">{{ (isset($verificationMode)) ? trans('global.update') : trans('global.create') }}</button>
</div>
