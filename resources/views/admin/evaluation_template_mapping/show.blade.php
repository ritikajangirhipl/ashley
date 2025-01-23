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
                            {{ $evaluationTemplateMapping->evaluationTemplates->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_template_mapping.fields.issuer_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplateMapping->evaluationTemplates->issuers->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_template_mapping.fields.issuer_degree_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplateMapping->evaluationTemplates->issuerDegree->qualification ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_template_mapping.fields.issuer_curriculum_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplateMapping->evaluationTemplates->issuerCurriculum->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_template_mapping.fields.issuer_curriculum_details_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplateMapping->issuerCurriculumDetail->school_ref ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_template_mapping.fields.receiver_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplateMapping->evaluationTemplates->receivers->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_template_mapping.fields.receiver_degree_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplateMapping->evaluationTemplates->receiverDegree->qualification ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_template_mapping.fields.receiver_curriculum_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplateMapping->evaluationTemplates->receiverCurriculum->name ?? '' }}
                        </td>
                    </tr>

                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_template_mapping.fields.receiver_curriculum_details_id') }}
                        </th>
                        <td>
                            {{ $evaluationTemplateMapping->receiverCurriculumDetail->school_ref ?? '' }}
                        </td>
                    </tr>
        
                    <tr>
                        <th>
                            {{ trans('cruds.evaluation_templates.fields.status') }}
                        </th>
                        <td>
                            {{ ucwords($evaluationTemplateMapping->status ?? '') }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-primary" href="{{ route('admin.evaluation-template-mappings.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
    
@endsection
