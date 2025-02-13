<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="order_id">{{ trans('cruds.processing.fields.order_id') }}<span class="text-danger">*</span></label>
            <select name="order_id" id="order_id" class="form-control select2 {{ $errors->has('order_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.processing.fields.order_id') }}</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ old('order_id', $processing->order_id ?? '') == $order->id ? 'selected' : '' }}>
                        {{ 'Order #' . $order->id }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.processing.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control select2 {{ $errors->has('status') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.processing.fields.status') }}</option>
                @foreach($status as $key => $value)
                    <option value="{{ $key }}" {{ old('status', $processing->status ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="verification_outcome">{{ trans('cruds.processing.fields.verification_outcome') }}</label>
            <select name="verification_outcome" id="verification_outcome" class="form-control select2 {{ $errors->has('verification_outcome') ? 'has-error' : '' }}">
                <option value="">{{ 'Select ' . trans('cruds.processing.fields.verification_outcome') }}</option>
                <option value="Passed" {{ old('verification_outcome', $processing->verification_outcome ?? '') == 'Passed' ? 'selected' : '' }}>Passed</option>
                <option value="Failed" {{ old('verification_outcome', $processing->verification_outcome ?? '') == 'Failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="outcome_evidence">{{ trans('cruds.processing.fields.outcome_evidence') }}</label>
            <input type="file" id="outcome_evidence" name="outcome_evidence" class="form-control {{ $errors->has('outcome_evidence') ? 'has-error' : '' }}">
            @if (isset($processing) && $processing->outcome_evidence)
                <small class="form-text text-muted">{{ trans('cruds.processing.fields.existing_file') }}: <a href="{{ Storage::url($processing->outcome_evidence) }}" target="_blank">{{ trans('cruds.processing.fields.view_file') }}</a></small>
            @endif
        </div>
    </div>
</div>

<div>
    @if(isset($processing))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>
