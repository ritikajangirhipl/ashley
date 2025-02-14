<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="category_id">{{ trans('cruds.sub_category.fields.category') }}<span class="text-danger">*</span></label>
            {{ Form::select('category_id', $categories, old('category_id', isset($subCategory) ? $subCategory->category_id : null), ['class' => 'form-control select2' . ($errors->has('category_id') ? ' has-error' : ''), 'id' => 'category_id', 'placeholder' => 'Select ' . trans('cruds.sub_category.fields.category'), 'required' => true]) }}
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.sub_category.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'has-error' : '' }}" value="{{ old('name', isset($subCategory) ? $subCategory->name : '') }}" required autofocus>
        </div>
    </div>

    
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="choose-image">
                <div>
                    <label for="image">{{ trans('cruds.sub_category.fields.image') }}<span class="text-danger">*</span></label>
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                </div>
                @isset($subCategory)
                    <div class="mt-2">
                        <img id="subcategoryImagePreview"
                            src="{{ asset('storage/' . $subCategory->image) }}"
                            alt="SubCategory Image"
                            width="100"
                            height="60"
                            class="img-thumbnail">
                    </div>
                @endisset

                @if($errors->has('image'))
                    <p class="help-block text-danger">
                        {{ $errors->first('image') }}
                    </p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.sub_category.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ isset($subCategory) && $subCategory->status == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.sub_category.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}">{{ old('description', isset($subCategory) ? $subCategory->description : '') }}</textarea>
        </div>
    </div>
</div>

<div>
    @if(isset($subCategory))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>