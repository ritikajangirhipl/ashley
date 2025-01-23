@extends('layouts.admin')
@section('title', $pageTitle)
@section('content')


<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">
            {{ trans('global.show') }} {{ trans('cruds.evaluation_templates.title_singular') }}
        </h4>
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.name') }}
                        </th>
                        <td>
                            {{ $evaluationTemplate->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.issuer_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplate->issuers->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.issuer_degree_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplate->issuerDegree->qualification ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.issuer_curriculum_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplate->issuerCurriculum->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.receiver_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplate->receivers->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.receiver_degree_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplate->receiverDegree->qualification ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.receiver_curriculum_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplate->receiverCurriculum->name ?? '' }}
                        </td>
                    </tr>
        
                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.status') }}
                        </th>
                        <td>
                            {{ ucwords($evaluationTemplate->status ?? '') }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-primary" href="{{ route('admin.evaluation-templates.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
    
@endsection
