<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="order_id">{{ trans('cruds.payment.fields.order_id') }}<span class="text-danger">*</span></label>
            <select name="order_id" id="order_id" class="form-control select2 {{ $errors->has('order_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.payment.fields.order_id') }}</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ old('order_id', $payment->order_id ?? '') == $order->id ? 'selected' : '' }}>
                        {{ $order->id }} - {{ $order->currency }} - {{ $order->amount }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="reference_number">{{ trans('cruds.payment.fields.reference_number') }}<span class="text-danger">*</span></label>
            <input type="text" id="reference_number" name="reference_number" class="form-control {{ $errors->has('reference_number') ? 'has-error' : '' }}" value="{{ old('reference_number', $payment->reference_number ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="evidence">{{ trans('cruds.payment.fields.evidence') }}<span class="text-danger">*</span></label>
            <input type="file" id="evidence" name="evidence" class="form-control {{ $errors->has('evidence') ? 'has-error' : '' }}">
            @if(isset($payment) && $payment->evidence)
                <p class="mt-2"><a href="{{ asset('storage/' . $payment->evidence) }}" target="_blank">{{ trans('global.view') }} PDF</a></p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="status">{{ trans('cruds.payment.fields.status') }}<span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-control select2 {{ $errors->has('status') ? 'has-error' : '' }}" required>
                <option value="">{{ trans('global.select') }} {{ trans('cruds.payment.fields.status') }}</option>
                @foreach(config('constant.enums.payment_status') as $key => $value)
                    <option value="{{ $key }}" {{ old('status', $payment->status ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="amount">{{ trans('cruds.payment.fields.amount') }}<span class="text-danger">*</span></label>
            <input type="number" id="amount" name="amount" class="form-control {{ $errors->has('amount') ? 'has-error' : '' }}" value="{{ old('amount', $payment->amount ?? '') }}" required step="0.01">
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="currency">{{ trans('cruds.payment.fields.currency') }}<span class="text-danger">*</span></label>
            <input type="text" id="currency" name="currency" class="form-control {{ $errors->has('currency') ? 'has-error' : '' }}" value="{{ old('currency', $payment->currency ?? '') }}" required>
        </div>
    </div>
</div>

<div>
    @if(isset($payment))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>
