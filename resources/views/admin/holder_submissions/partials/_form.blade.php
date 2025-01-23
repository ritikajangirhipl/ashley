<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('submission_date') ? 'has-error' : '' }}">
            <label for="submission_date">{{ trans('cruds.holder_submissions.fields.submission_date') }}<span class="text-danger">*</span></label>
            <div class="input-field-inner position-relative">
                <input type="text" name="submission_date" id="submission_date" class="form-control submission_date" value="{{ old('submission_date', isset($holderSubmission) ? $holderSubmission->submission_date : '') }}" required size="30"/>
                <span class="add-on calendar"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
            @if($errors->has('submission_date'))
                <p class="help-block">
                    {{ $errors->first('submission_date') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('student_id') ? 'has-error' : '' }}">
            <label for="student_id">{{ trans('cruds.holder_submissions.fields.student_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('student_id', $students, old('student_id', isset($holderSubmission) ? $holderSubmission->student_id : null), ['class' => 'form-control select2 student_id','id'=>'student_id','placeholder'=>'Select '.trans('cruds.holder_submissions.fields.student_id'),'required'=>'true']) }}

            @if($errors->has('student_id'))
                <p class="help-block">
                    {{ $errors->first('student_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('issuer_id') ? 'has-error' : '' }}">
            <label for="issuer_id">{{ trans('cruds.holder_submissions.fields.issuer_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('issuer_id', $issuers, old('issuer_id', isset($holderSubmission) ? $holderSubmission->issuer_id : null), ['class' => 'form-control select2 issuer_id','id'=>'issuer_id','placeholder'=>'Select '.trans('cruds.holder_submissions.fields.issuer_id'),'required'=>'true']) }}

            @if($errors->has('issuer_id'))
                <p class="help-block">
                    {{ $errors->first('issuer_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('issuer_degree_id') ? 'has-error' : '' }}">
            <label for="issuer_degree_id">{{ trans('cruds.holder_submissions.fields.issuer_degree_id') }}<span class="text-danger">*</span></label>
            {!! Form::select('issuer_degree_id',[''=>'Select '.trans('cruds.holder_submissions.fields.issuer_degree_id')],null,['class'=>'form-control select2 issuer_degree_id', 'id'=>'issuer_degree_id','required'=>'true','data-selected'=>isset($holderSubmission) ? $holderSubmission->issuer_degree_id : ""]) !!}

            @if($errors->has('issuer_degree_id'))
                <p class="help-block">
                    {{ $errors->first('issuer_degree_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('receiver_id') ? 'has-error' : '' }}">
            <label for="receiver_id">{{ trans('cruds.holder_submissions.fields.receiver_id') }}<span class="text-danger">*</span></label>
            {{ Form::select('receiver_id', $receivers, old('receiver_id', isset($holderSubmission) ? $holderSubmission->receiver_id : null), ['class' => 'form-control select2 receiver_id','id'=>'receiver_id','placeholder'=>'Select '.trans('cruds.holder_submissions.fields.receiver_id'),'required'=>'true']) }}

            @if($errors->has('receiver_id'))
                <p class="help-block">
                    {{ $errors->first('receiver_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('receiver_degree_id') ? 'has-error' : '' }}">
            <label for="receiver_degree_id">{{ trans('cruds.holder_submissions.fields.receiver_degree_id') }}<span class="text-danger">*</span></label>
            {!! Form::select('receiver_degree_id',[''=>'Select '.trans('cruds.holder_submissions.fields.receiver_degree_id')],null,['class'=>'form-control select2 receiver_degree_id', 'id'=>'receiver_degree_id','required'=>'true','data-selected'=>isset($holderSubmission) ? $holderSubmission->receiver_degree_id : ""]) !!}

            @if($errors->has('receiver_degree_id'))
                <p class="help-block">
                    {{ $errors->first('receiver_degree_id') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('receiver_reference') ? 'has-error' : '' }}">
            <label for="receiver_reference">{{ trans('cruds.holder_submissions.fields.receiver_reference') }}<span class="text-danger">*</span></label>
            <input type="text" id="receiver_reference" name="receiver_reference" class="form-control" value="{{ old('receiver_reference', isset($holderSubmission) ? $holderSubmission->receiver_reference : '') }}" required>
            @if($errors->has('receiver_reference'))
                <p class="help-block">
                    {{ $errors->first('receiver_reference') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('school_name') ? 'has-error' : '' }}">
            <label for="school_name">{{ trans('cruds.holder_submissions.fields.school_name') }}<span class="text-danger">*</span></label>
            <input type="text" id="school_name" name="school_name" class="form-control" value="{{ old('school_name', isset($holderSubmission) ? $holderSubmission->school_name : '') }}" required>
            @if($errors->has('school_name'))
                <p class="help-block">
                    {{ $errors->first('school_name') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="input-append date form-group {{ $errors->has('start_year') ? 'has-error' : '' }}">
            <label for="start_year">{{ trans('cruds.holder_submissions.fields.start_year') }}<span class="text-danger">*</span></label>
            <div class="input-field-inner position-relative">
                <input type="text" name="start_year" class="form-control start_year" value="{{ old('start_year', isset($holderSubmission) ? $holderSubmission->start_year : '') }}" required size="30" readonly />
                <span class="add-on calendar"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
            @if($errors->has('start_year'))
                <p class="help-block">
                    {{ $errors->first('start_year') }}
                </p>
            @endif
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="input-append date form-group {{ $errors->has('end_year') ? 'has-error' : '' }}">
            <label for="end_year">{{ trans('cruds.holder_submissions.fields.end_year') }}<span class="text-danger">*</span></label>
            <div class="input-field-inner position-relative">
                <input type="text" name="end_year" class="form-control end_year" value="{{ old('end_year', isset($holderSubmission) ? $holderSubmission->end_year : '') }}" required size="30" readonly/>
                <span class="add-on calendar"><i class="fa-solid fa-calendar-days"></i></span>
            </div>
            @if($errors->has('end_year'))
                <p class="help-block">
                    {{ $errors->first('end_year') }}
                </p>
            @endif
        </div>
    </div>

    @foreach(config('constant.holder_submission_documents') as $key => $file)
        <div class="col-md-6 col-sm-12">
            <div class="form-group {{ $errors->has($key) ? 'has-error' : '' }}">
                <label for="o_level_certificate">{{ trans('cruds.holder_submissions.fields.'.$key) }}</label>
                @php
                    $filePath = null;
                    if(isset($holderSubmission)){
                        $uploadData = $holderSubmission->uploads()->where('document_file_type',$key)->first();
                        if($uploadData){
                            if(isset($uploadData) && isset($uploadData->path) && Storage::disk('public')->exists($uploadData->path)){
                                $filePath = asset('storage/'.$uploadData->path);
                            }
                        }
                    }
                @endphp
                <input type="file" name="{{$key}}" id="{{$key}}" class="dropify" data-default-file="{{ $filePath ?? '' }}" data-allowed-file-extensions="pdf" data-max-file-size-preview="5M" accept="application/pdf">
                @if($errors->has($key))
                    <p class="help-block text-danger">
                        {{ $errors->first($key) }}
                    </p>
                @endif
                <input type="hidden" name="{{$key}}_is_remove" id="{{$key}}_removed" value="0">
            </div>
        </div>
    @endforeach

    <div class="col-md-6 col-sm-12">
            <div class="form-group {{ $errors->has('fees_to_pay') ? 'has-error' : '' }}">
                <label for="fees_to_pay">{{ trans('cruds.holder_submissions.fields.fees_to_pay') }}<span class="text-danger">*</span></label>
                <input type="number" step="0.01" id="fees_to_pay" name="fees_to_pay" class="form-control" value="{{ old('fees_to_pay', isset($holderSubmission) ? $holderSubmission->fees_to_pay : '') }}" readonly min="1">

                @if($errors->has('fees_to_pay'))
                    <p class="help-block">
                        {{ $errors->first('fees_to_pay') }}
                    </p>
                @endif
            </div>
        </div>    

    <div class="col-md-6 col-sm-12">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label for="status">{{ trans('cruds.holder_submissions.fields.status') }}<span class="text-danger">*</span></label>
            {{ Form::select('status', $status, old('status', isset($holderSubmission) ? $holderSubmission->status : null), ['class' => 'form-control select2 type','id'=>'status','placeholder'=>'Select '.trans('cruds.holder_submissions.fields.status'),'required'=>'true']) }}

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