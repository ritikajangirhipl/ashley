@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.receiver.title') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.name') }}
                        </th>
                        <td>
                            {{ $receiver->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.initial') }}
                        </th>
                        <td>
                            {{ $receiver->initial ?? '' }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.country_id') }}
                        </th>
                        <td>
                            {{ $receiver->country->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.website_url') }}
                        </th>
                        <td>
                            {{ $receiver->website_url ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.email') }}
                        </th>
                        <td>
                            {{ $receiver->email ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.password') }}
                        </th>
                        <td>
                            {{ $receiver->password ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.contact_name') }}
                        </th>
                        <td>
                            {{ $receiver->contact_name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.contact_number') }}
                        </th>
                        <td>
                            {{ $receiver->contact_number ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.contact_email') }}
                        </th>
                        <td>
                            {{ $receiver->contact_email ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.receiver.fields.status') }}
                        </th>
                        <td>
                            {{ $receiver->status ?? '' }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-primary" href="{{ route('admin.receivers.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
    
@endsection
