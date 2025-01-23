<table class="table table-bordered table-responsive-md table-responsive-sm">
    <thead>
        <tr>
            <th>{{ trans('cruds.extract_transcript.fields.level') }}</th>
            <th>{{ trans('cruds.extract_transcript.fields.course_name') }}</th>
            <th>{{ trans('cruds.extraction_report.fields.code') }}</th>
            <th>{{ trans('cruds.extract_transcript.fields.earned') }}</th>
            <th>{{ trans('cruds.extract_transcript.fields.grade') }}</th>
            <th>{{ trans('cruds.extract_transcript.fields.point') }}</th>
        </tr>
    </thead>
    <tbody>
        @if(isset($extractTranscript) && !empty($extractTranscript))
            @foreach($extractTranscript->extractTranscriptMappings as $key => $extractMapping)
                <tr>
                    <td>{{ $extractMapping->issuerCurriculumDetail->levelMaster->title ?? "" }}</td>
                    <td>{{ $extractMapping->issuerCurriculumDetail->course_name ?? "" }}</td>
                    <td>{{ $extractMapping->issuerCurriculumDetail->course_code ?? "" }}</td>
                    <td>
                        <input type="number" name="mappings[{{$key}}][earned]" placeholder="{{ trans('cruds.extract_transcript.fields.earned') }}" value="{{ $extractMapping->earned }}" class="form-control earned_{{ $key }}">
                    </td>
                    <td>
                        <input type="text" name="mappings[{{$key}}][grade]" placeholder="{{ trans('cruds.extract_transcript.fields.grade') }}" value="{{ $extractMapping->grade }}" class="form-control grade_{{ $key }} text-uppercase">
                    </td>
                    <td>
                        <input type="number" name="mappings[{{$key}}][point]" placeholder="{{ trans('cruds.extract_transcript.fields.point') }}" value="{{ $extractMapping->point }}" class="form-control point_{{ $key }}">
                    </td>  
                    <input type="hidden" class="evaluation_template_mapping_id_{{ $key }}" name="mappings[{{$key}}][evaluation_template_mapping_id]" value="{{ $extractMapping->evaluation_template_mapping_id }}">
                    <input type="hidden" class="issuer_curriculum_details_id_{{ $key }}" name="mappings[{{$key}}][issuer_curriculum_details_id]" value="{{ $extractMapping->issuer_curriculum_details_id ?? null }}">
                    <input type="hidden" class="extract_transcript_id_{{ $key }}" name="mappings[{{$key}}][extract_transcript_id]" value="{{ $extractMapping->extract_transcript_id }}">
                </tr>
            @endforeach
        @elseif(isset($mappings) && $mappings->count() > 0)
            @foreach($mappings as $key => $mapping)
                <tr>          
                    <td>{{ $mapping->level ?? "" }}</td>
                    <td>{{ $mapping->course_name ?? "" }}</td>
                    <td>{{ $mapping->course_code ?? "" }}</td>
                    <td>
                        <input type="number" name="mappings[{{$key}}][earned]" placeholder="{{ trans('cruds.extract_transcript.fields.earned') }}" value="{{ $mapping->earned ?? '' }}" class="form-control earned_{{ $key }}">
                    </td>
                    <td>
                        <input type="text" name="mappings[{{$key}}][grade]" placeholder="{{ trans('cruds.extract_transcript.fields.grade') }}" value="{{ $mapping->grade ?? '' }}" class="form-control grade_{{ $key }} text-uppercase">
                    </td>
                    <td>
                        <input type="number" name="mappings[{{$key}}][point]" placeholder="{{ trans('cruds.extract_transcript.fields.point') }}" value="{{ $mapping->point ?? '' }}" class="form-control point_{{ $key }}">
                    </td>  
                    <input type="hidden" class="evaluation_template_mapping_id_{{ $key }}" name="mappings[{{$key}}][evaluation_template_mapping_id]" value="{{ $mapping->evaluation_template_mapping_id ?? null }}">
                    <input type="hidden" class="issuer_curriculum_details_id_{{ $key }}" name="mappings[{{$key}}][issuer_curriculum_details_id]" value="{{ $mapping->issuer_curriculum_details_id ?? null }}">
                    <input type="hidden" class="extract_transcript_id_{{ $key }}" name="mappings[{{$key}}][extract_transcript_id]" value="{{ $mapping->extract_transcript_id ?? null }}">
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">{{ trans('global.no_results') }}</td>
            </tr>
        @endif
    </tbody>
</table>