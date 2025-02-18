<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="category_id">{{ trans('cruds.sub_category.fields.category') }}<span class="text-danger">*</span></label>
            {{ Form::select('category_id', $categories, (isset($subCategory) ? $subCategory->category_id : null), ['class' => 'form-control select2', 'id' => 'category_id', 'placeholder' => 'Select ' . trans('cruds.sub_category.fields.category'), 'required' => true]) }}
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.sub_category.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ isset($subCategory) ? $subCategory->name : '' }}" required autofocus>
        </div>
    </div>

    
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <div class="choose-image">
                <div>
                    <label for="image">{{ trans('cruds.sub_category.fields.image') }}<span class="text-danger">*</span></label>
                    <input type="file" name="image" id="imageInput" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" accept="image/*">
                </div>
                @if(isset($subCategory) && $subCategory->image)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $subCategory->image) }}" data-fancybox="gallery">
                            <img id="subcategoryImagePreview" src="{{ asset('storage/' . $subCategory->image) }}" alt="SubCategory Image" class="img-thumbnail" width="100">
                        </a>
                    </div>
                @endif
                <div class="mt-2">
                    <a id="previewImgLink" href="#" data-fancybox="gallery" style="display: none;">
                        <img id="previewImg" src="#" alt="Image Preview" class="img-thumbnail" width="100" style="display: none;">
                    </a>
                </div>
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
            <textarea name="description" class="form-control">{{ isset($subCategory) ? $subCategory->description : '' }}</textarea>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-info" type="submit">{{ (isset($subCategory)) ? trans('global.update') : trans('global.create') }}</button>
</div>
