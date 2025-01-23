@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.'.request()->degreeType.'.title_singular') }} {{ trans('cruds.degrees.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.'.request()->degreeType.'_id') }}
                        </th>
                        <td>
                            {{ $degree->degrable->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.qualification') }}
                        </th>
                        <td>
                            {{ $degree->qualification ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.accreditation_status') }}
                        </th>
                        <td>
                            {{ ucwords($degree->accreditation_status ?? '') }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.accreditation_body_id') }}
                        </th>
                        <td>
                            {{ $degree->accreditationBody->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.program_length_required') }}
                        </th>
                        <td>
                            {{ $degree->program_length_required ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.course_type') }}
                        </th>
                        <td>
                            {{ $courseType[$degree->course_type] ?? ''}}
                        </td>
                    </tr>
                    @if($degree->isIssuerDegree())
                        <tr>
                            <th>
                                {{ trans('cruds.degrees.fields.specialization') }}
                            </th>
                            <td>
                                {{ $degree->specialization ?? '' }}
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.admission_requirement_1') }}
                        </th>
                        <td>
                            {{ $degree->admission_requirement_1 ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.admission_requirement_2') }}
                        </th>
                        <td>
                            {{ $degree->admission_requirement_2 ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.degrees.fields.status') }}
                        </th>
                        <td>
                            {{ ucwords($degree->status ?? '') }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-primary" href="{{ route('admin.degrees.index',request()->degreeType) }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
    
@endsection
