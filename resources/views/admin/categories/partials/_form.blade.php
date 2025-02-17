<div class="row">
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.category.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ isset($category) ? $category->name : '' }}" required autofocus>
        </div>
    </div>
    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.category.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ isset($category) && $category->status == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="form-group">
            <div class="choose-image">
                <div>
                    <label for="image">{{ trans('cruds.category.fields.image') }}<span class="text-danger">*</span></label>
                    <input type="file" id="image" name="image" class="form-control {{ $errors->has('image') ? 'has-error' : '' }}" accept="image/*">
                </div>
                @if(isset($category) && $category->image)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $category->image) }}" data-fancybox="gallery">
                            <img id="categoryImagePreview" src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="img-thumbnail" width="100">
                        </a>
                    </div>
                @endif
                <div class="mt-2">
                    <a id="imagePreviewLink" href="#" data-fancybox="gallery" style="display: none;">
                        <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail" width="100" style="display: none;">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.category.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control {{ $errors->has('description') ? 'has-error' : '' }}" required>{{ isset($category) ? $category->description : '' }}</textarea>
        </div>
    </div>
</div>

<div>
    <button class="btn btn-info" type="submit">{{ (isset($category)) ? trans('global.update') : trans('global.create') }}</button>
</div>
