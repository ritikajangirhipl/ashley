<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.evidence_type.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ isset($evidenceType) ? $evidenceType->name : '' }}" placeholder="{{ trans('cruds.evidence_type.fields.name') }}" autofocus>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.evidence_type.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" required class="form-control select2">
            @foreach($status as $key => $value)
                <option value="{{ $key }}" {{ isset($evidenceType) && $evidenceType->status == $key ? 'selected' : '' }}>
                    {{ $value }}
                </option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.evidence_type.fields.description') }}<span class="text-danger">*</span></label>
            <textarea name="description" class="form-control" placeholder="{{ trans('cruds.evidence_type.fields.description') }}">{{ isset($evidenceType) ? $evidenceType->description : '' }}</textarea>
        </div>
    </div>
</div>
<div>
    <button class="btn btn-info" type="submit">{{ (isset($evidenceType)) ? trans('global.update') : trans('global.create') }}</button>
</div>

