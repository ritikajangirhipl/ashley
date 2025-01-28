<div class="row">
    <!-- Name Field -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="name">{{ trans('cruds.evidence_type.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', isset($evidenceType) ? $evidenceType->name : '') }}" placeholder="{{ trans('cruds.evidence_type.fields.name') }}" autofocus>
            
            <!-- Display error message for 'name' field -->
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Description Field -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="description">{{ trans('cruds.evidence_type.fields.description') }}</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ trans('cruds.evidence_type.fields.description') }}">{{ old('description', isset($evidenceType) ? $evidenceType->description : '') }}</textarea>
            
            <!-- Display error message for 'description' field -->
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <!-- Status Field -->
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.evidence_type.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($evidenceType) ? $evidenceType->status : null), ['class' => 'form-control select2' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => trans('global.select')]) }}

            <!-- Display error message for 'status' field -->
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div>
    <!-- Submit Button -->
    @if(isset($evidenceType))
        <input class="btn btn-info" type="submit" value="{{ trans('global.update') }}">
    @else
        <input class="btn btn-info" type="submit" value="{{ trans('global.create') }}">
    @endif
</div>

