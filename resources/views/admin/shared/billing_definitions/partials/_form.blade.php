<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('billable_id') ? 'has-error' : '' }}">
            <label for="billable_id">{{ trans('cruds.billing_definitions.fields.'.request()->billingType.'_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('billable_id', $billingTypes, old('billable_id', isset($billingDefinition) ? $billingDefinition->billable_id : null), ['class' => 'form-control select2 billable_id','id'=>'billable_id','placeholder'=>trans('global.select')." ".trans('cruds.billing_definitions.fields.'.request()->billingType.'_id'),'required'=>'true']) }}

            @if($errors->has('billable_id'))
                <p class="help-block">
                    {{ $errors->first('billable_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('degree_id') ? 'has-error' : '' }}">
            <label for="degree_id">{{ trans('cruds.billing_definitions.fields.degree_id') }}<span class="text-danger">*</span></label>
           
            {!! Form::select('degree_id',[''=>'Select '.ucwords(request()->billingType).' First'],null,['class'=>'form-control select2 degree_id', 'id'=>'degree_id','required'=>'true','data-selected'=>isset($billingDefinition) ? $billingDefinition->degree_id : ""]) !!}

            @if($errors->has('degree_id'))
                <p class="help-block">
                    {{ $errors->first('degree_id') }}
                </p>
            @endif
        </div>
    </div>

    @if(request()->billingType == "receiver")        
        <div class="col-md-6 col-sm-12">
            <div class="form-group {{ $errors->has('receiver_fees') ? 'has-error' : '' }}">
                <label for="receiver_fees">{{ trans('cruds.billing_definitions.fields.receiver_fees') }}<span class="text-danger">*</span></label>
                <input type="number" step="0.01" id="receiver_fees" name="receiver_fees" class="form-control" value="{{ old('receiver_fees', isset($billingDefinition) ? $billingDefinition->receiver_fees : '') }}" min="0" required>

                @if($errors->has('receiver_fees'))
                    <p class="help-block">
                        {{ $errors->first('receiver_fees') }}
                    </p>
                @endif
            </div>
        </div>
    @else
        <div class="col-md-6 col-sm-12">
            <div class="form-group {{ $errors->has('evaluation_fees') ? 'has-error' : '' }}">
                <label for="evaluation_fees">{{ trans('cruds.billing_definitions.fields.evaluation_fees') }}<span class="text-danger">*</span></label>
                <input type="number" step="0.01" id="evaluation_fees" name="evaluation_fees" class="form-control" value="{{ old('evaluation_fees', isset($billingDefinition) ? $billingDefinition->evaluation_fees : '') }}" min="0" required>

                @if($errors->has('evaluation_fees'))
                    <p class="help-block">
                        {{ $errors->first('evaluation_fees') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="form-group {{ $errors->has('translation_fees') ? 'has-error' : '' }}">
                <label for="translation_fees">{{ trans('cruds.billing_definitions.fields.translation_fees') }}<span class="text-danger">*</span></label>
                <input type="number" step="0.01" id="translation_fees" name="translation_fees" class="form-control" value="{{ old('translation_fees', isset($billingDefinition) ? $billingDefinition->translation_fees : '') }}" min="0" required>

                @if($errors->has('translation_fees'))
                    <p class="help-block">
                        {{ $errors->first('translation_fees') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="form-group {{ $errors->has('verification_fees') ? 'has-error' : '' }}">
                <label for="verification_fees">{{ trans('cruds.billing_definitions.fields.verification_fees') }}<span class="text-danger">*</span></label>
                <input type="number" step="0.01" id="verification_fees" name="verification_fees" class="form-control" value="{{ old('verification_fees', isset($billingDefinition) ? $billingDefinition->verification_fees : '') }}" min="0" required>

                @if($errors->has('verification_fees'))
                    <p class="help-block">
                        {{ $errors->first('verification_fees') }}
                    </p>
                @endif
            </div>
        </div>
        
    @endif
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('other_fees') ? 'has-error' : '' }}">
            <label for="other_fees">{{ trans('cruds.billing_definitions.fields.other_fees') }}<span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="other_fees" name="other_fees" class="form-control" value="{{ old('other_fees', isset($billingDefinition) ? $billingDefinition->other_fees : '') }}" min="0" required>

            @if($errors->has('other_fees'))
                <p class="help-block">
                    {{ $errors->first('other_fees') }}
                </p>
            @endif
        </div>
    </div>
    
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('total_fees') ? 'has-error' : '' }}">
            <label for="total_fees">{{ trans('cruds.billing_definitions.fields.total_fees') }}<span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="total_fees" name="total_fees" class="form-control" value="{{ old('total_fees', isset($billingDefinition) ? $billingDefinition->total_fees : '') }}" min="0" required>

            @if($errors->has('total_fees'))
                <p class="help-block">
                    {{ $errors->first('total_fees') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.billing_definitions.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($billingDefinition) ? $billingDefinition->status : null), ['class' => 'form-control select2 type','id'=>'status','placeholder'=>'Select '.trans('cruds.billing_definitions.fields.status'),'required'=>'true']) }}

            @if($errors->has('status'))
                <p class="help-block">
                    {{ $errors->first('status') }}
                </p>
            @endif
        </div>
    </div>
    
</div>

<div>
    <input class="btn btn-info" type="submit" value="{{ trans('global.save') }}">
</div>