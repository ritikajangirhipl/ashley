<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('CategoryID') ? 'has-error' : '' }}">
            <label for="CategoryID">{{ trans('cruds.sub_category.fields.category') }}<span class="text-danger">*</span></label>
            {{ Form::select('CategoryID', $categories, old('CategoryID', isset($subCategory) ? $subCategory->CategoryID : null), ['class' => 'form-control select2', 'id' => 'CategoryID', 'placeholder' => 'Select ' . trans('cruds.sub_category.fields.category'), 'required' => 'true']) }}
            @if($errors->has('CategoryID'))
                <p class="help-block">
                    {{ $errors->first('CategoryID') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.sub_category.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($subCategory) ? $subCategory->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <label for="description">{{ trans('cruds.sub_category.fields.description') }}</label>
            <textarea name="description" class="form-control">{{ old('description', isset($subCategory) ? $subCategory->description : '') }}</textarea>
            @if($errors->has('description'))
                <p class="help-block">
                    {{ $errors->first('description') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.sub_category.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($subCategory) ? $subCategory->status : null), ['class' => 'form-control select2', 'id' => 'status', 'placeholder' => 'Select ' . trans('cruds.sub_category.fields.status'), 'required' => 'true']) }}
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