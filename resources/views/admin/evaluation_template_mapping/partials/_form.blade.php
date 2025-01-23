<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="form-group {{ $errors->has('evaluation_template_id') ? 'has-error' : '' }}">
            <label for="evaluation_template_id">{{ trans('cruds.evaluation_template_mapping.fields.evaluation_template_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('evaluation_template_id', $evaluationTemplate, old('evaluation_template_id', isset($evaluationTemplateMapping) ? $evaluationTemplateMapping->evaluation_template_id : null), ['class' => 'form-control select2 evaluation_template_id','id'=>'evaluation_template_id','placeholder'=>'Select '.trans('cruds.evaluation_template_mapping.fields.evaluation_template_id'),'required'=>'true']) }}

            @if($errors->has('evaluation_template_id'))
                <p class="help-block">
                    {{ $errors->first('evaluation_template_id') }}
                </p>
            @endif
        </div>
    </div>

    <div id="evaluation-templates" class="col-md-12 col-sm-12" style="display:none">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="issuer_id">{{ trans('cruds.evaluation_template_mapping.fields.issuer_id') }}<span class="text-danger">*</span></label>
                    <div id="issuer_id" class="form-control disabled"></div>            
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="receiver_id">{{ trans('cruds.evaluation_template_mapping.fields.receiver_id') }}<span class="text-danger">*</span></label>
                    <div id="receiver_id" class="form-control disabled"></div>            
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="issuer_degree_id">{{ trans('cruds.evaluation_template_mapping.fields.issuer_degree_id') }}<span class="text-danger">*</span></label>
                    <div id="issuer_degree_id" class="form-control disabled"></div>            
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="receiver_degree_id">{{ trans('cruds.evaluation_template_mapping.fields.receiver_degree_id') }}<span class="text-danger">*</span></label>
                    <div id="receiver_degree_id" class="form-control disabled"></div>            
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="issuer_curriculum_id">{{ trans('cruds.evaluation_template_mapping.fields.issuer_curriculum_id') }}<span class="text-danger">*</span></label>
                    <div id="issuer_curriculum_id" class="form-control disabled"></div>            
                </div>
            </div>

            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="receiver_curriculum_id">{{ trans('cruds.evaluation_template_mapping.fields.receiver_curriculum_id') }}<span class="text-danger">*</span></label>
                    <div id="receiver_curriculum_id" class="form-control disabled"></div>            
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('issuer_curriculum_details_id') ? 'has-error' : '' }}">
            <label for="issuer_curriculum_details_id">{{ trans('cruds.evaluation_template_mapping.fields.issuer_curriculum_details_id') }}<span class="text-danger">*</span></label>
            {!! Form::select('issuer_curriculum_details_id',[''=>'Select '.trans('cruds.evaluation_template_mapping.fields.issuer_curriculum_details_id')],old('issuer_curriculum_details_id', isset($evaluationTemplateMapping) ? $evaluationTemplateMapping->issuer_curriculum_details_id : null),['class'=>'form-control select2 issuer_curriculum_details_id', 'id'=>'issuer_curriculum_details_id','required'=>'true','data-selected'=>isset($evaluationTemplateMapping) ? $evaluationTemplateMapping->issuer_curriculum_details_id : ""]) !!}

            @if($errors->has('issuer_curriculum_details_id'))
                <p class="help-block">
                    {{ $errors->first('issuer_curriculum_details_id') }}
                </p>
            @endif
        </div>
    </div>


    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('receiver_curriculum_details_id') ? 'has-error' : '' }}">
            <label for="receiver_curriculum_details_id">{{ trans('cruds.evaluation_template_mapping.fields.receiver_curriculum_details_id') }}<span class="text-danger">*</span></label>
            {!! Form::select('receiver_curriculum_details_id',[''=>'Select '.trans('cruds.evaluation_template_mapping.fields.receiver_curriculum_details_id')],old('receiver_curriculum_details_id', isset($evaluationTemplateMapping) ? $evaluationTemplateMapping->receiver_curriculum_details_id : null),['class'=>'form-control select2 receiver_curriculum_details_id', 'id'=>'receiver_curriculum_details_id','required'=>'true','data-selected'=>isset($evaluationTemplateMapping) ? $evaluationTemplateMapping->receiver_curriculum_details_id : ""]) !!}

            @if($errors->has('receiver_curriculum_details_id'))
                <p class="help-block">
                    {{ $errors->first('receiver_curriculum_details_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.evaluation_template_mapping.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($evaluationTemplateMapping) ? $evaluationTemplateMapping->status : null), ['class' => 'form-control select2 type','id'=>'status','placeholder'=>'Select '.trans('cruds.evaluation_template_mapping.fields.status'),'required'=>'true']) }}

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