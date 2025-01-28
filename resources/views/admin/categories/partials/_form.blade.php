<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.category.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name', isset($category) ? $category->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block text-danger">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.category.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" required>{{ old('description', isset($category) ? $category->description : '') }}</textarea>
            @if($errors->has('description'))
                <p class="help-block text-danger">
                    {{ $errors->first('description') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.category.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($category) ? $category->status : null), ['class' => 'form-control select2 type ' . ($errors->has('status') ? 'is-invalid' : ''), 'id'=>'status','placeholder'=>'Select '.trans('cruds.category.fields.status'),'required'=>'true']) }}
            @if($errors->has('status'))
                <p class="help-block text-danger">
                    {{ $errors->first('status') }}
                </p>
            @endif
        </div>
    </div>
</div>

<div>
    @if(isset($category))
        <input class="btn btn-info" type="submit" value="{{ trans('global.update') }}">
    @else
        <input class="btn btn-info" type="submit" value="{{ trans('global.create') }}">
    @endif
</div>