<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="client_id">{{ trans('cruds.order.fields.client') }}<span class="text-danger">*</span></label>
            <select name="client_id" id="client_id" class="form-control select2 {{ $errors->has('client_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.client') }}</option>
                @foreach($clients as $id => $name)
                    <option value="{{ $id }}" {{ old('client_id', $order->client_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="service_id">{{ trans('cruds.order.fields.service') }}<span class="text-danger">*</span></label>
            <select name="service_id" id="service_id" class="form-control select2 {{ $errors->has('service_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.service') }}</option>
                @foreach($services as $id => $name)
                    <option value="{{ $id }}" {{ old('service_id', $order->service_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="location_id">{{ trans('cruds.order.fields.location') }}<span class="text-danger">*</span></label>
            <select name="location_id" id="location_id" class="form-control select2 {{ $errors->has('location_id') ? 'has-error' : '' }}" required>
                <option value="">{{ 'Select ' . trans('cruds.order.fields.location') }}</option>
                @foreach($locations as $id => $name)
                    <option value="{{ $id }}" {{ old('location_id', $order->location_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="order_amount">{{ trans('cruds.order.fields.order_amount') }}<span class="text-danger">*</span></label>
            <input type="text" id="order_amount" name="order_amount" class="form-control {{ $errors->has('order_amount') ? 'has-error' : '' }}" value="{{ old('order_amount', $order->order_amount ?? '') }}" required>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="order_status">{{ trans('cruds.order.fields.order_status') }}<span class="text-danger">*</span></label>
            <select name="order_status" id="order_status" required class="form-control select2">
                @foreach($statuses as $key => $value)
                    <option value="{{ $key }}" {{ old('order_status', $order->order_status ?? '') == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div>
    @if(isset($order))
        <button class="btn btn-info" type="submit">{{ trans('global.update') }}</button>
    @else
        <button class="btn btn-info" type="submit">{{ trans('global.create') }}</button>
    @endif
</div>
