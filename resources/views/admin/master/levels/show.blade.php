@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')

<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.levels.title') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2 normal_width_table">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.levels.fields.title') }}
                        </th>
                        <td>
                            {{ $levelMaster->title }}
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
