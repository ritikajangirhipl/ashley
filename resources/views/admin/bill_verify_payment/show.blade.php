@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.students.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.students.fields.name') }}
                        </th>
                        <td>
                            {{ $student->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.students.fields.email') }}
                        </th>
                        <td>
                            {{ $student->email ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.students.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $student->phone_number ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.students.fields.dob') }}
                        </th>
                        <td>
                            {{ \Carbon\Carbon::parse($student->dob ?? '')->format('d-F-Y') }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.students.fields.password') }}
                        </th>
                        <td>
                            {{ $student->password ?? '' }}
                        </td>
                    </tr>
        
                    <tr>
                        <th>
                            {{ trans('cruds.students.fields.status') }}
                        </th>
                        <td>
                            {{ ucwords($student->status ?? '') }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ route('admin.students.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
    
@endsection
