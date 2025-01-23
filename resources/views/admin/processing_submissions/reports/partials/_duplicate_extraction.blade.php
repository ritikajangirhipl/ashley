
@foreach($duplicateRecords as $dKey => $duplicateRecord)
    @php
        unset($duplicateCourses[$key]); // to remove fetched record

        $schoolRef += 0.01;
        $totalCredits += $duplicateRecord->course_credits ?? 0.00;
        $receiverCurriculumDetail = null;

        if($duplicateRecord->issuerEvaluationTemplateMapping){
            $receiverCurriculumDetail = $duplicateRecord->issuerEvaluationTemplateMapping->receiverCurriculumDetail;

            $receiverlevel = $receiverCurriculumDetail->levelMaster->title ?? "";
            $totalReceiverCredits += $receiverCurriculumDetail->course_credits ?? 0.00;
        }
    @endphp
    <tr>
        <td align="right">{{ sprintf('%0.2f', $schoolRef) }}</td>
        <td align="right">{{ $issuerlevel }}</td>
        <td >{{ $duplicateRecord->course_code ?? "" }}</td>
        <td >{{ $duplicateRecord->course_name ?? "" }}</td>
        <td align="right">{{ $duplicateRecord->course_credits ?? "" }}</td>
        <td align="right"></td>
        <td align="right"></td>
        <td align="right"></td>                                    
        <td align="right">{{ ($receiverCurriculumDetail) ? sprintf('%0.2f', $schoolRef) : "" }}</td>
        <td align="right">{{ ($receiverCurriculumDetail) ? $receiverlevel : "" }}</td>
        <td>{{ $receiverCurriculumDetail->course_code ?? "" }}</td>
        <td>{{ $receiverCurriculumDetail->course_name ?? "" }}</td>
        <td align="right">{{ $receiverCurriculumDetail->course_credits ?? "" }}</td>
    </tr>    
@endforeach

@if($showTotalRow)
<!-- blank row -->                    
<tr>
    <td></td>
    <td></td>
    <td ></td>
    <td ></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
<!-- show total row -->  
<tr>
    <td></td>
    <td align="right"><b>{{ $issuerlevel ?? "" }}</b></td>
    <td></td>
    <td><b>Total {{ $issuerlevel ?? "" }} Level</b></td>
    <td align="right"><b>{{ $totalCredits }}</b></td>
    <td align="right"><b>{{ $totalEarned }}</b></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td align="right"><b>{{ $totalReceiverCredits }}</b></td>
</tr>
@if($i < $totalBatch)
    <!-- blank row for next level -->  
    <tr>
        <td colspan="13" class="blank-column"></td>
    </tr>
@endif
@endif