<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('submission_id') ? 'has-error' : '' }}">
            <label for="submission_id">{{ trans('cruds.bill_verify_payments.fields.submission_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('submission_id', $submission, old('submission_id', isset($holderSubmission) ? $holderSubmission->submission_id : null), ['class' => 'form-control select2 submission_id','id'=>'submission_id','placeholder'=>'Select '.trans('cruds.bill_verify_payments.fields.submission_id'),'required'=>'true']) }}

            @if($errors->has('submission_id'))
                <p class="help-block">
                    {{ $errors->first('submission_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('payment_status') ? 'has-error' : '' }}">
            <label for="payment_status">{{ trans('cruds.bill_verify_payments.fields.payment_status') }}<span class="text-danger">*</span></label>
            {{ Form::select('payment_status', $paymentStatus, old('payment_status', isset($holderSubmission) ? $holderSubmission->payment_status : null), ['class' => 'form-control select2 type','id'=>'payment_status','placeholder'=>'Select '.trans('cruds.bill_verify_payments.fields.payment_status'),'required'=>'true']) }}

            @if($errors->has('payment_status'))
                <p class="help-block">
                    {{ $errors->first('payment_status') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12 amount_to_bill" style="display:none">
        <div class="form-group {{ $errors->has('amount_to_bill') ? 'has-error' : '' }}">
            <label for="amount_to_bill">{{ trans('cruds.bill_verify_payments.fields.amount_to_bill') }}<span class="text-danger">*</span></label>
            <input type="number" step="0.01" id="amount_to_bill" name="amount_to_bill" class="form-control" value="" min="1">

            @if($errors->has('amount_to_bill'))
                <p class="help-block">
                    {{ $errors->first('amount_to_bill') }}
                </p>
            @endif
        </div>
    </div>
</div>

<div>
    <div class="text-right">
        <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)" style="display: none;">Previous</button>
        <button type="button" class="btn btn-info" id="nextBtn" onclick="nextPrev(1)">Next</button>
    </div>
</div>