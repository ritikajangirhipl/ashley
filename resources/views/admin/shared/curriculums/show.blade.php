<table class="table table-bordered table-striped">
    <tbody>
        <tr>
            <th>
                {{ trans('cruds.curriculums.fields.name') }}
            </th>
            <td>
                {{ $curriculum->name }}
            </td>
        </tr>  
        <tr>
            <th>
                {{ trans('cruds.degrees.fields.'.request()->type.'_id') }}
            </th>
            <td>
                {{ $curriculum->curriculumable->name ?? "" }}
            </td>
        </tr>
        <tr>
            <th>
                {{ trans('cruds.curriculums.fields.qualification') }}
            </th>
            <td>
                {{ $curriculum->degree->qualification ?? "" }}
            </td>
        </tr>  
        <tr>
            <th>
                {{ trans('cruds.curriculums.fields.status') }}
            </th>
            <td>
                {{ $curriculum->status ?? "" }}
            </td>
        </tr> 
        <tr>
            <th>
                {{ trans('cruds.curriculums.fields.created_at') }}
            </th>
            <td>
                {{ $curriculum->created_at->format(config('app.date_time_format')) ?? "" }}
            </td>
        </tr>        
    </tbody>
</table>