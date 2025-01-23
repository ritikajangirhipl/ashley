<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title">{{ trans('cruds.permission.fields.title') }}<span class="required">*</span></label>
    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->title : '') }}" required>
    @if($errors->has('title'))
        <p class="help-block">
            {{ $errors->first('title') }}
        </p>
    @endif
</div>
<div>
    <input class="btn btn-info" type="submit" value="{{ trans('global.save') }}">
</div>