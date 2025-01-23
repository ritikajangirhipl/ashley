@csrf
<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
    <label for="title">{{ trans('cruds.levels.fields.title') }}*</label>
    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($levelMaster) ? $levelMaster->title : '') }}" required autofocus>
    <p class="error title help-block"></p>
</div>
<div>
    <input class="btn btn-danger saveBtn" type="submit" value="{{ trans('global.save') }}">
</div>
