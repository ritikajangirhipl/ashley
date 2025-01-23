<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.evaluation_templates.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($evaluationTemplate) ? $evaluationTemplate->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('issuer_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.evaluation_templates.fields.issuer_id') }}<span class="required">*</span></label>
            {{ Form::select('issuer_id', $issuerTypes, old('issuer_id', isset($evaluationTemplate) ? $evaluationTemplate->issuer_id : null), ['data-type'=>'issuer', 'class' => 'form-control select2 issuer_id','id'=>'issuer_id','placeholder'=>trans('global.select')." ".trans('cruds.evaluation_templates.fields.issuer_id'),'required'=>'true']) }}
            
            @if($errors->has('issuer_id'))
                <p class="help-block">
                    {{ $errors->first('issuer_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('receiver_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.evaluation_templates.fields.receiver_id') }}<span class="required">*</span></label>
            {{ Form::select('receiver_id', $receiverTypes, old('receiver_id', isset($evaluationTemplate) ? $evaluationTemplate->receiver_id : null), ['data-type'=>'receiver', 'class' => 'form-control select2 receiver_id','id'=>'receiver_id','placeholder'=>trans('global.select')." ".trans('cruds.evaluation_templates.fields.receiver_id'),'required'=>'true']) }}
            
            @if($errors->has('receiver_id'))
                <p class="help-block">
                    {{ $errors->first('receiver_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('issuer_degree_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.evaluation_templates.fields.issuer_degree_id') }}<span class="required">*</span></label>
            {!! Form::select('issuer_degree_id',[''=>'Select Issuer First'],null,['class'=>'form-control select2 issuer_degree_id', 'id'=>'issuer_degree_id','required'=>'true','data-selected'=>isset($evaluationTemplate) ? $evaluationTemplate->issuer_degree_id : ""]) !!}
            
            @if($errors->has('issuer_degree_id'))
                <p class="help-block">
                    {{ $errors->first('issuer_degree_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('receiver_degree_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.evaluation_templates.fields.receiver_degree_id') }}<span class="required">*</span></label>
            {!! Form::select('receiver_degree_id',[''=>'Select Receiver First'],null,['class'=>'form-control select2 receiver_degree_id', 'id'=>'receiver_degree_id','required'=>'true','data-selected'=>isset($evaluationTemplate) ? $evaluationTemplate->receiver_degree_id : ""]) !!}
            
            @if($errors->has('receiver_degree_id'))
                <p class="help-block">
                    {{ $errors->first('receiver_degree_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('issuer_curriculum_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.evaluation_templates.fields.issuer_curriculum_id') }}<span class="required">*</span></label>
            {!! Form::select('issuer_curriculum_id',[''=>'Select Issuer Degree First'],null,['class'=>'form-control select2 issuer_curriculum_id', 'id'=>'issuer_curriculum_id','required'=>'true','data-selected'=>isset($evaluationTemplate) ? $evaluationTemplate->issuer_curriculum_id : ""]) !!}
            
            @if($errors->has('issuer_curriculum_id'))
                <p class="help-block">
                    {{ $errors->first('issuer_curriculum_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('receiver_curriculum_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.evaluation_templates.fields.receiver_curriculum_id') }}<span class="required">*</span></label>
            {!! Form::select('receiver_curriculum_id',[''=>'Select Issuer Degree First'],null,['class'=>'form-control select2 receiver_curriculum_id', 'id'=>'receiver_curriculum_id','required'=>'true','data-selected'=>isset($evaluationTemplate) ? $evaluationTemplate->receiver_curriculum_id : ""]) !!}
            
            @if($errors->has('receiver_curriculum_id'))
                <p class="help-block">
                    {{ $errors->first('receiver_curriculum_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.evaluation_templates.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($evaluationTemplate) ? $evaluationTemplate->status : null), ['class' => 'form-control select2 type','id'=>'status','placeholder'=>'Select '.trans('cruds.evaluation_templates.fields.status'),'required'=>'true']) }}

            @if($errors->has('status'))
                <p class="help-block">
                    {{ $errors->first('status') }}
                </p>
            @endif
        </div>
    </div>

</div>

<div>
    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
</div>