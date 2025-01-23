@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.issuer.title') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.name') }}
                        </th>
                        <td>
                            {{ $issuer->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.initial') }}
                        </th>
                        <td>
                            {{ $issuer->initial ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.country_id') }}
                        </th>
                        <td>
                            {{ $issuer->country->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.type') }}
                        </th>
                        <td>
                            {{ $issuer->type ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.recognition_status') }}
                        </th>
                        <td>
                            {{ $issuer->recognition_status ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.accreditation_status') }}
                        </th>
                        <td>
                            {{ $issuer->accreditation_status ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.accreditation_body_id') }}
                        </th>
                        <td>
                            {{ $issuer->accreditationBody->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.website_url') }}
                        </th>
                        <td>
                            {{ $issuer->website_url ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.email') }}
                        </th>
                        <td>
                            {{ $issuer->email ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.address') }}
                        </th>
                        <td>
                            {{ $issuer->address ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.contact_name') }}
                        </th>
                        <td>
                            {{ $issuer->contact_name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.contact_number') }}
                        </th>
                        <td>
                            {{ $issuer->contact_number ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $issuer->contact_email ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.issuer.fields.status') }}
                        </th>
                        <td>
                            {{ $issuer->status ?? '' }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-primary" href="{{ route('admin.issuers.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
    
@endsection
