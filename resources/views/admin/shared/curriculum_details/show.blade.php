<table class="table table-bordered table-striped">
    <tbody>
        <tr>
            <th>
                {{ ucwords($type) }} {{ trans('cruds.curriculum_details.fields.name') }}
            </th>
            <td>
                {{ $curriculumDetail->curriculum->curriculumable->name ?? '' }}
            </td>
        </tr>
        <tr>
            <th>
                {{ ucwords($type) }} {{ trans('cruds.curriculum_details.fields.degree') }}
            </th>
            <td>
                {{ $curriculumDetail->curriculum->degree->qualification ?? '' }}
            </td>
        </tr>
        <tr>
            <th>
                {{ ucwords($type) }} {{ trans('cruds.curriculum_details.fields.curriculum') }}
            </th>
            <td>
                {{ $curriculumDetail->curriculum->name ?? '' }}
            </td>
        </tr>
        <tr>
            <th>
                {{ trans('cruds.curriculum_details.fields.level_master_id') }}
            </th>
            <td>
                {{ $curriculumDetail->levelMaster->title ?? '' }}
            </td>
        </tr>  
        <tr>
            <th>
                {{ trans('cruds.curriculum_details.fields.course_code') }}
            </th>
            <td>
                {{ $curriculumDetail->course_code ?? '' }}
            </td>
        </tr>
        <tr>
            <th>
                {{ trans('cruds.curriculum_details.fields.course_name') }}
            </th>
            <td>
                {{ $curriculumDetail->course_name ?? '' }}
            </td>
        </tr>
        <tr>
            <th>
                {{ trans('cruds.curriculum_details.fields.course_credits') }}
            </th>
            <td>
                {{ $curriculumDetail->course_credits ?? '' }}
            </td>
        </tr>
        <tr>
            <th>
                {{ trans('cruds.curriculum_details.fields.school_ref') }}
            </th>
            <td>
                {{ $curriculumDetail->school_ref ?? '' }}
            </td>
        </tr>  
        <tr>
            <th>
                {{ trans('cruds.curriculum_details.fields.status') }}
            </th>
            <td>
                {{ ucwords( $curriculumDetail->status ?? '' ) }}
            </td>
        </tr> 
        <tr>
            <th>
                {{ trans('cruds.curriculum_details.fields.created_at') }}
            </th>
            <td>
                {{ $curriculumDetail->created_at->format(config('app.date_time_format')) ?? '' }}
            </td>
        </tr>        
    </tbody>
</table>