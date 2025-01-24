<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.verification_mode.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($verificationMode) ? $verificationMode->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description">{{ trans('cruds.verification_mode.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" required>{{ old('description', isset($verificationMode) ? $verificationMode->description : '') }}</textarea>
            @if($errors->has('description'))
                <p class="help-block">
                    {{ $errors->first('description') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.verification_mode.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($verificationMode) ? $verificationMode->status : null), ['class' => 'form-control select2', 'id' => 'status', 'placeholder' => 'Select ' . trans('cruds.verification_mode.fields.status'), 'required' => 'true']) }}
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