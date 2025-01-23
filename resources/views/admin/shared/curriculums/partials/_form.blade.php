@csrf
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name">{{ trans('cruds.curriculums.fields.name') }}<span class="required">*</span></label>
    <input type="text" id="name" name="name" class="form-control name" value="{{ old('name', isset($curriculum) ? $curriculum->name : '') }}" required>
    @if($errors->has('name'))
        <p class="help-block">
            {{ $errors->first('name') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('curriculumable_id') ? 'has-error' : '' }}">
    <label for="name">{{ trans('cruds.curriculums.fields.'.request()->type.'_id') }}<span class="required">*</span></label>
    {{ Form::select('curriculumable_id', $types, old('curriculumable_id', isset($curriculum) ? $curriculum->curriculumable_id : null), ['class' => 'form-control select2 curriculumable_id','id'=>'curriculumable_id','placeholder'=>trans('cruds.issuer.select_type',['attribute' => ucwords(request()->type)]),'required'=>'true']) }}
    
    @if($errors->has('curriculumable_id'))
        <p class="help-block">
            {{ $errors->first('curriculumable_id') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('degree_id') ? 'has-error' : '' }}">
    <label for="name">{{ trans('cruds.curriculums.fields.qualification') }}<span class="required">*</span></label>
    {!! Form::select('degree_id',[''=>'Select '.trans('cruds.curriculums.fields.qualification')],null,['class'=>'form-control select2 degree_id', 'id'=>'degree_id','required'=>'true','data-selected'=>isset($curriculum) ? $curriculum->degree_id : ""]) !!}
    
    @if($errors->has('degree_id'))
        <p class="help-block">
            {{ $errors->first('degree_id') }}
        </p>
    @endif
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="name">{{ trans('cruds.curriculums.fields.status') }}<span class="required">*</span></label>
    {{ Form::select('status', $status, old('status', isset($curriculum) ? $curriculum->status : null), ['class' => 'form-control select2 status','id'=>'status','placeholder'=>'Select '.trans('cruds.degrees.fields.status'),'required'=>'true']) }}
    
    @if($errors->has('status'))
        <p class="help-block">
            {{ $errors->first('status') }}
        </p>
    @endif
</div>

<div>
    <input class="btn btn-info" id="saveButton" type="submit" value="{{ trans('global.save') }}">
</div> 
