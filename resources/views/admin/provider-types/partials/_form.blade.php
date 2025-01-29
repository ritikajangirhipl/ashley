<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.provider_type.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" value="{{ old('name', isset($providerType) ? $providerType->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block text-danger">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.provider_type.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" required>{{ old('description', isset($providerType) ? $providerType->description : '') }}</textarea>
            @if($errors->has('description'))
                <p class="help-block text-danger">
                    {{ $errors->first('description') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.provider_type.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($providerType) ? $providerType->status : null), ['class' => 'form-control select2'.($errors->has('status') ? 'has-error' : ''), 'id' => 'status', 'placeholder' => 'Select ' . trans('cruds.provider_type.fields.status'), 'required' => 'true']) }}
            @if($errors->has('status'))
                <p class="help-block text-danger">
                    {{ $errors->first('status') }}
                </p>
            @endif
        </div>
    </div>
</div>

<div>
    @if(isset($providerType))
        <input class="btn btn-info" type="submit" value="{{ trans('global.update') }}">
    @else
        <input class="btn btn-info" type="submit" value="{{ trans('global.create') }}">
    @endif
</div>