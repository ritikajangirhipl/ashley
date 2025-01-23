<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name">{{ trans('cruds.students.fields.name') }}<span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($student) ? $student->name : '') }}" required autofocus>
            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <label for="email">{{ trans('cruds.students.fields.email') }}<span class="text-danger">*</span></label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($student) ? $student->email : '') }}" required>
            @if($errors->has('email'))
                <p class="help-block">
                    {{ $errors->first('email') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
            <label for="phone_number">{{ trans('cruds.students.fields.phone_number') }}<span class="text-danger">*</span></label>
            <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number', isset($student) ? $student->phone_number : '') }}" required>
            @if($errors->has('phone_number'))
                <p class="help-block">
                    {{ $errors->first('phone_number') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
            <label for="dob">{{ trans('cruds.students.fields.dob') }}<span class="text-danger">*</span></label>
            <div class="input-field-inner position-relative">
                <input type="text" name="dob" class="form-control" id="dob" value="{{ old('dob', isset($student) ? $student->dob : '') }}" required size="30"/>
                <span class="add-on calendar"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
            @if($errors->has('dob'))
                <p class="help-block">
                    {{ $errors->first('dob') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <label for="password">{{ trans('cruds.students.fields.password') }}<span class="text-danger">*</span></label>
            <input type="text" id="password" name="password" class="form-control" value="{{ old('password', isset($student) ? $student->password : '') }}" required>
            @if($errors->has('password'))
                <p class="help-block">
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.students.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($student) ? $student->status : null), ['class' => 'form-control select2 type','id'=>'status','placeholder'=>'Select '.trans('cruds.students.fields.status'),'required'=>'true']) }}

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