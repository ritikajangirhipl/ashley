<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.category.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ isset($category) ? $category->name : '' }}" required autofocus>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="image">{{ trans('cruds.category.fields.image') }}</label>
            <input type="file" id="image" name="image" class="form-control" accept="image/*">

            @if(isset($category) && $category->image)
                <div class="mt-2">
                    <img id="categoryImagePreview" src="{{ asset('storage/' . $category->image) }}" alt="Category Image" class="img-thumbnail" width="100">
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.category.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" required>{{ isset($category) ? $category->description : '' }}</textarea>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 mb-3">
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
</div>

<div>
    @if(isset($category))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>
