@csrf
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('curriculumable_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.curriculums.fields.'.request()->type.'_id') }}<span class="required">*</span></label>
            {{ Form::select('curriculumable_id', $types, old('curriculumable_id', isset($curriculum) ? $curriculum->curriculumable_id : null), ['class' => 'form-control select2 curriculumable_id','id'=>'curriculumable_id','placeholder'=>trans('global.select_type',['attribute' => ucwords(request()->type)]),'required'=>'true']) }}
            
            @if($errors->has('curriculumable_id'))
                <p class="help-block">
                    {{ $errors->first('curriculumable_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('degree_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.degrees.title_singular') }}<span class="required">*</span></label>
            {!! Form::select('degree_id',[''=>'Select '.trans('cruds.degrees.title_singular')],null,['class'=>'form-control select2 degree_id', 'id'=>'degree_id','required'=>'true','data-selected'=>isset($curriculum) ? $curriculum->degree_id : ""]) !!}
            
            @if($errors->has('degree_id'))
                <p class="help-block">
                    {{ $errors->first('degree_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('curriculum_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.curriculum_details.fields.'.request()->type.'_id') }}<span class="required">*</span></label>
            {!! Form::select('curriculum_id',[''=>'Select '.trans('cruds.curriculum_details.fields.'.request()->type.'_id')],null,['class'=>'form-control select2 curriculum_id', 'id'=>'curriculum_id','required'=>'true','data-selected'=>isset($curriculumDetail) ? $curriculumDetail->curriculum_id : ""]) !!}
            
            @if($errors->has('curriculum_id'))
                <p class="help-block">
                    {{ $errors->first('curriculum_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('level_master_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.curriculum_details.fields.level_master_id') }}<span class="required">*</span></label>
            {{ Form::select('level_master_id', $levelMaster, old('level_master_id', isset($curriculumDetail) ? $curriculumDetail->level_master_id : null), ['class' => 'form-control select2 level_master_id','id'=>'level_master_id','placeholder'=>'Select '.trans('cruds.curriculum_details.fields.level_master_id'),'required'=>'true']) }}
            @if($errors->has('level_master_id'))
                <p class="help-block">
                    {{ $errors->first('level_master_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('course_code') ? 'has-error' : '' }}">
            <label for="course_code">{{ trans('cruds.curriculum_details.fields.course_code') }}<span class="required">*</span></label>
            <input type="text" id="course_code" name="course_code" class="form-control course_code" value="{{ old('course_code', isset($curriculumDetail) ? $curriculumDetail->course_code : '') }}" required>
            @if($errors->has('course_code'))
                <p class="help-block">
                    {{ $errors->first('course_code') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('course_name') ? 'has-error' : '' }}">
            <label for="course_name">{{ trans('cruds.curriculum_details.fields.course_name') }}<span class="required">*</span></label>
            <input type="text" id="course_name" name="course_name" class="form-control course_name" value="{{ old('course_name', isset($curriculumDetail) ? $curriculumDetail->course_name : '') }}" required>
            @if($errors->has('course_name'))
                <p class="help-block">
                    {{ $errors->first('course_name') }}
                </p>
            @endif
        </div>        
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('course_credits') ? 'has-error' : '' }}">
            <label for="course_credits">{{ trans('cruds.curriculum_details.fields.course_credits') }}<span class="required">*</span></label>
            <input type="number" id="course_credits" name="course_credits" class="form-control course_credits" value="{{ old('course_credits', isset($curriculumDetail) ? $curriculumDetail->course_credits : '') }}" min="0" required>
            @if($errors->has('course_credits'))
                <p class="help-block">
                    {{ $errors->first('course_credits') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.curriculum_details.fields.status') }}<span class="required">*</span></label>
            {{ Form::select('status', $status, old('status', isset($curriculumDetail) ? $curriculumDetail->status : null), ['class' => 'form-control select2 status','id'=>'status','placeholder'=>'Select '.trans('cruds.curriculum_details.fields.status'),'required'=>'true']) }}
            @if($errors->has('status'))
                <p class="help-block">
                    {{ $errors->first('status') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <input class="btn btn-info" id="saveButton" type="submit" value="{{ trans('global.save') }}">
    </div>

</div> 
