@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.accreditation_bodies.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2 normal_width_table">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.accreditation_bodies.fields.name') }}
                        </th>
                        <td>
                            {{ $accreditationBody->name ?? "" }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.accreditation_bodies.fields.country_id') }}
                        </th>
                        <td>
                            {{ $accreditationBody->country->name ?? "" }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a class="btn btn-primary mt-2" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection
