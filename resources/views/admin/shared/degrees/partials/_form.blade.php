<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('degrable_id') ? 'has-error' : '' }}">
            <label for="degrable_id">{{ trans('cruds.degrees.fields.'.request()->degreeType.'_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('degrable_id', $degreeTypes, old('degrable_id', isset($degree) ? $degree->degrable_id : null), ['class' => 'form-control select2 degrable_id','id'=>'degrable_id','placeholder'=>trans('global.select')." ".trans('cruds.degrees.fields.'.request()->degreeType.'_id'),'required'=>'true']) }}

            @if($errors->has('degrable_id'))
                <p class="help-block">
                    {{ $errors->first('degrable_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('qualification') ? 'has-error' : '' }}">
            <label for="qualification">{{ trans('cruds.degrees.fields.qualification') }}<span class="text-danger">*</span></label>
            <input type="text" id="qualification" name="qualification" class="form-control" value="{{ old('qualification', isset($degree) ? $degree->qualification : '') }}" required>
            @if($errors->has('qualification'))
                <p class="help-block">
                    {{ $errors->first('qualification') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
            <label for="country_id">{{ trans('cruds.degrees.fields.country_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('country_id', $countries, old('country_id', isset($degree) ? $degree->country_id : null), ['class' => 'form-control select2 country_id','id'=>'country_id','placeholder'=>trans('cruds.degrees.fields.country_id'),'required'=>'true']) }}

            @if($errors->has('country_id'))
                <p class="help-block">
                    {{ $errors->first('country_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('accreditation_status') ? 'has-error' : '' }}">
            <label for="accreditation_status">{{ trans('cruds.degrees.fields.accreditation_status') }}<span class="text-danger">*</span></label>
            {{ Form::select('accreditation_status', $accreditationStatus, old('accreditation_status', isset($degree) ? $degree->accreditation_status : null), ['class' => 'form-control select2 type','id'=>'accreditation_status','placeholder'=>'Select '.trans('cruds.degrees.fields.accreditation_status'),'required'=>'true']) }}

            @if($errors->has('accreditation_status'))
                <p class="help-block">
                    {{ $errors->first('accreditation_status') }}
                </p>
            @endif
        </div>
    </div>

    <!-- <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('accreditation_body_id') ? 'has-error' : '' }}">
            <label for="accreditation_body_id">{{ trans('cruds.degrees.fields.accreditation_body_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('accreditation_body_id', $accreditationBodies, old('accreditation_body_id', isset($degree) ? $degree->accreditation_body_id : null), ['class' => 'form-control select2 type','id'=>'accreditation_body_id','placeholder'=>'Select '.trans('cruds.degrees.fields.accreditation_body_id'),'required'=>'true']) }}

            @if($errors->has('accreditation_body_id'))
                <p class="help-block">
                    {{ $errors->first('accreditation_body_id') }}
                </p>
            @endif
        </div>
    </div> -->

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('accreditation_body_id') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.degrees.fields.accreditation_body_id') }}<span class="required">*</span></label>
            {!! Form::select('accreditation_body_id',[''=>'Select Country First'],null,['class'=>'form-control select2 accreditation_body_id', 'id'=>'accreditation_body_id','required'=>'true','data-selected'=>isset($degree) ? $degree->accreditation_body_id : ""]) !!}
            
            @if($errors->has('accreditation_body_id'))
                <p class="help-block">
                    {{ $errors->first('accreditation_body_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('program_length_required') ? 'has-error' : '' }}">
            <label for="program_length_required">{{ trans('cruds.degrees.fields.program_length_required') }}<span class="text-danger">*</span></label>
            <input type="text" id="program_length_required" name="program_length_required" class="form-control" value="{{ old('program_length_required', isset($degree) ? $degree->program_length_required : '') }}" required>
            @if($errors->has('program_length_required'))
                <p class="help-block">
                    {{ $errors->first('program_length_required') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('course_type') ? 'has-error' : '' }}">
            <label for="course_type">{{ trans('cruds.degrees.fields.course_type') }}<span class="text-danger">*</span></label>
            {{ Form::select('course_type', $courseType, old('course_type', isset($degree) ? $degree->course_type : null), ['class' => 'form-control select2 type','id'=>'course_type','placeholder'=>'Select '.trans('cruds.degrees.fields.course_type'),'required'=>'true']) }}

            @if($errors->has('course_type'))
                <p class="help-block">
                    {{ $errors->first('course_type') }}
                </p>
            @endif
        </div>
    </div>

    @if(request()->degreeType == 'issuer')
        <div class="col-md-6 col-sm-12">
            <div class="form-group {{ $errors->has('specialization') ? 'has-error' : '' }}">
                <label for="specialization">{{ trans('cruds.degrees.fields.specialization') }}<span class="text-danger">*</span></label>
                <input type="text" id="specialization" name="specialization" class="form-control" value="{{ old('specialization', isset($degree) ? $degree->specialization : '') }}" required>
                @if($errors->has('specialization'))
                    <p class="help-block">
                        {{ $errors->first('specialization') }}
                    </p>
                @endif
            </div>
        </div>
    @endif

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('admission_requirement_1') ? 'has-error' : '' }}">
            <label for="admission_requirement_1">{{ trans('cruds.degrees.fields.admission_requirement_1') }}<span class="text-danger">*</span></label>
            <input type="text" id="admission_requirement_1" name="admission_requirement_1" class="form-control" value="{{ old('admission_requirement_1', isset($degree) ? $degree->admission_requirement_1 : '') }}" required>
            @if($errors->has('admission_requirement_1'))
                <p class="help-block">
                    {{ $errors->first('admission_requirement_1') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('admission_requirement_2') ? 'has-error' : '' }}">
            <label for="admission_requirement_2">{{ trans('cruds.degrees.fields.admission_requirement_2') }}<span class="text-danger">*</span></label>
            <input type="text" id="admission_requirement_2" name="admission_requirement_2" class="form-control" value="{{ old('admission_requirement_2', isset($degree) ? $degree->admission_requirement_2 : '') }}" required>
            @if($errors->has('admission_requirement_2'))
                <p class="help-block">
                    {{ $errors->first('admission_requirement_2') }}
                </p>
            @endif
        </div>
    </div>

    <div class="{{request()->degreeType != 'issuer' ? 'col-md-6':''}} col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.degrees.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($degree) ? $degree->status : null), ['class' => 'form-control select2 type','id'=>'status','placeholder'=>'Select '.trans('cruds.degrees.fields.status'),'required'=>'true']) }}

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