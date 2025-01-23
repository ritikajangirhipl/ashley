<style type="text/css" scoped>    
    /*body {
        margin: 0 !important;
        font-family: 'Inter', sans-serif;
    }*/
    .heading-data {
        text-align: center;
        /*font-size: 13px !important;*/
        font-weight: 600;
        padding: 15px;
        /*margin-top: 50px;*/
    }
    .page-break {        
        page-break-after: always;
    }
    .extraction-heading-main th {
        font-size: 13px !important;
        padding: 2px 0;
        border-bottom: 1px solid #000;
        text-align: center;
    }
    .border-main {
        border-bottom: 0;
    }
    .extraction-report-inner th{
        font-size: 12px !important;
        text-align: left;
        padding:2px 3px;
        vertical-align: top;
        font-weight: 800;
    }
    .table-responsive-extraction td {
        border: 1px solid #000;
    }
    .extraction-report-inner td{
        font-size: 11px !important;
        padding: 2px 3px;
    }
    .lightgreen. .volitgreen {
        text-transform: uppercase;
    }
    .lightgreen {
        background: #A8D08D;
        font-weight: 800;
        border-left: 0 !important;
    }
    .volitgreen {
        background: #FFFF00;
        font-weight: 800;
        border-right: 0 !important;
    }
    .extraction-report-inner td {
        border-right: 1px solid #000;
        border-top: 1px solid #000;
    }
    .extraction-report-inner tr:last-child td {
        border-bottom: 1px solid #000;
    }
    .extraction-report-inner th {
        border-right: 1px solid #000;
    }
    .extraction-report-inner th:first-child, 
    .extraction-report-inner td:first-child {
        border-left: 1px solid #000;
    }    
    .mt-20{
        margin-top: 10px;
    }
    .border-top{
        border-top: 1px solid #000;
    }
    .extraction-report-inner b {
        font-size: 12px !important;
        font-weight: 800;
    }
    .blank-column {
        height: 15px;
        border-left: 0 !important;
        border-right: 0 !important;
    }
    .extraction-report-inner td:empty {
        height: 14px;
    }
    .table-responsive-extraction {
        display: block;
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        -ms-overflow-style: -ms-autohiding-scrollbar;
    }
</style>
<section class="extraction-report">
    
    <div class="table-responsive-extraction">
        <table class="border-main mt-20 issuer-to-receiver" cellspacing="0" cellpadding="0" width="100%">
            <thead class="extraction-heading-main">
                <tr>
                    <td colspan="13" style="border: none;">
                        <div class="heading-data">{{ $holderSubmission->submission_ref ?? "" }} - {{ $holderSubmission->students->name ?? "" }} - {{ $holderSubmission->receiver_reference ?? '' }}</div>
                    </td>
                </tr>
                <tr>
                    <th class="lightgreen" width="60%" colspan="8">{{ trans('cruds.extraction_report.headings.results_evaluation') }}</th>
                    <th class="volitgreen" width="40%" colspan="5">{{ trans('cruds.extraction_report.headings.mlscn_comparision') }}</th>
                </tr>
            </thead>
            <thead class="extraction-report-inner">
                <tr>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.school_ref') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.level') }}</th>
                    <th width="8%">{{ trans('cruds.extraction_report.fields.code') }}</th>
                    <th width="24%">{{ trans('cruds.extraction_report.fields.course_name') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.credits') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.earned') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.grade') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.points') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.mlscn_ref') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.level') }}</th>
                    <th width="8%">{{ trans('cruds.extraction_report.fields.course_code') }}</th>
                    <th width="24%">{{ trans('cruds.extraction_report.fields.course_title') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.mlscn_credits') }}</th>
                </tr>
            </thead>
            <tbody class="extraction-report-inner">
                @if($issuerMappings && $issuerMappings->count() > 0)
                    @php                        
                        $totalBatch = $issuerMappings->count();
                        $i=0;
                        $levelsCountArr = [];
                    @endphp
                    @foreach($issuerMappings as $batchKey => $mappingBatch)
                        @php
                            ++$i;
                            $totallevel = $mappingBatch->count();
                            $totalCredits = 0;
                            $totalEarned = 0;
                            $totalReceiverCredits = 0;

                            $batchLevel = $mappingBatch->first()->level ?? "";

                            $schoolRef = (int)substr($batchLevel, 0, 1);

                            $duplicateRecords = $duplicateCourses->where('level',$batchLevel);
                            
                            $totallevel += $duplicateRecords->count(); 
                            $levelsCountArr[$batchLevel]   =  $totallevel;
                        @endphp
                        @foreach($mappingBatch as $key => $record)
                            @php
                                $schoolRef += 0.01;
                                $issuerlevel = $record->level ?? "";
                                $totalCredits += $record->course_credits ?? 0.00;
                                $totalEarned += $record->earned ?? 0.00;

                                $receiverCurriculumDetail = null;

                                if($record->receiver_curriculum_details_id){

                                    $receiverCurriculumDetail = \App\Models\CurriculumDetail::find($record->receiver_curriculum_details_id);

                                    $receiverlevel = $receiverCurriculumDetail->levelMaster->title ?? "";
                                    $totalReceiverCredits += $receiverCurriculumDetail->course_credits ?? 0.00;
                                }
                                
                            @endphp
                            <tr>
                                <td align="right">{{ sprintf('%0.2f', $schoolRef) }}</td>
                                <td align="right">{{ $issuerlevel }}</td>
                                <td >{{ $record->course_code ?? "" }}</td>
                                <td >{{ $record->course_name ?? "" }}</td>
                                <td align="right">{{ $record->course_credits ?? "" }}</td>
                                <td align="right">{{ $record->earned ?? "" }}</td>
                                <td align="right">{{ $record->grade ?? "" }}</td>
                                <td align="right">{{ $record->point ?? "" }}</td>                                
                                <td align="right">{{ ($receiverCurriculumDetail) ? sprintf('%0.2f', $schoolRef) : "" }}</td>
                                <td align="right">{{ ($receiverCurriculumDetail) ? $receiverlevel : "" }}</td>
                                <td>{{ $receiverCurriculumDetail->course_code ?? "" }}</td>
                                <td>{{ $receiverCurriculumDetail->course_name ?? "" }} </td>
                                <td align="right">{{ $receiverCurriculumDetail->course_credits ?? "" }}</td>
                            </tr>        
                        @endforeach

                        @if($duplicateRecords && !empty($duplicateRecords) && $duplicateRecords->count() > 0)
                            @include('admin.processing_submissions.reports.partials._duplicate_extraction',['duplicateRecords'=>$duplicateRecords,'issuerlevel'=>$issuerlevel,'schoolRef'=>$schoolRef,'totalCredits'=>$totalCredits,'totalReceiverCredits'=>$totalReceiverCredits,'showTotalRow'=>false,'totalEarned'=>$totalEarned,'totalBatch'=>$totalBatch])
                        @endif

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
                            <td><b>Total {{ $batchLevel ?? "" }} Level</b></td>
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

                        @if($i < $totalBatch || $duplicateCourses->count() > 0)
                            <!-- blank row for next level -->  
                            <tr>
                                <td colspan="13" class="blank-column"></td>
                            </tr>
                        @endif
                    @endforeach

                    @if($duplicateCourses && !empty($duplicateCourses) && $duplicateCourses->count() > 0)
                        @php
                            $duplicateCourseBatches = $duplicateCourses->sortBy('level')->groupBy('level');
                        @endphp
                        @if($duplicateCourseBatches && $duplicateCourseBatches->count() > 0)
                            @php                        
                                $totalBatch = $duplicateCourseBatches->count();
                                $i=0;
                            @endphp
                            @foreach($duplicateCourseBatches as $key => $duplicateRecords)
                                @php
                                    ++$i;
                                    $totalCredits = 0;
                                    $totalEarned = 0;
                                    $totalReceiverCredits = 0;
                                    $issuerlevel = $duplicateRecords->first()->level ?? "";
                                    $schoolRef = (int)substr($issuerlevel, 0, 1);
                                    if(array_key_exists($issuerlevel,$levelsCountArr)){
                                        $previousCount = $levelsCountArr[$issuerlevel];
                                        $schoolRef = $schoolRef+($previousCount/100);
                                    }
                                @endphp
                                @include('admin.processing_submissions.reports.partials._duplicate_extraction',['duplicateRecords'=>$duplicateRecords,'issuerlevel'=>$issuerlevel,'schoolRef'=>$schoolRef,'totalCredits'=>$totalCredits,'totalReceiverCredits'=>$totalReceiverCredits,'showTotalRow'=>true,'totalEarned'=>$totalEarned,'totalBatch'=>$totalBatch])
                            @endforeach
                        @endif
                        
                    @endif

                @endif


            </tbody>
        </table>

        <!-- page break -->
        <div class="page-break"></div>
        <!-- page break -->

        <div style="clear: both;">

        <table class="border-main mt-20 receiver-to-issuer" cellspacing="0" cellpadding="0" width="100%">
            <thead class="extraction-heading-main">
                <tr>
                    <td colspan="13" style="border: none;">
                        <div class="heading-data">{{ $holderSubmission->submission_ref ?? "" }} - {{ $holderSubmission->students->name ?? "" }} - {{ $holderSubmission->receiver_reference ?? '' }}</div>
                    </td>
                </tr>
                
                <tr>
                    <th class="volitgreen" width="40%" colspan="5">
                    {{ trans('cruds.extraction_report.headings.mlscn_comparision') }}</th>
                    <th class="lightgreen" width="80%" colspan="8">
                    {{ trans('cruds.extraction_report.headings.results_evaluation') }}</th>
                </tr>
            </thead>
            <thead class="extraction-report-inner">
                <tr>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.mlscn_ref') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.level') }}</th>
                    <th width="8%">{{ trans('cruds.extraction_report.fields.course_code') }}</th>
                    <th width="24%">{{ trans('cruds.extraction_report.fields.course_title') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.mlscn_credits') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.school_ref') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.level') }}</th>
                    <th width="8%">{{ trans('cruds.extraction_report.fields.code') }}</th>
                    <th width="24%">{{ trans('cruds.extraction_report.fields.course_name') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.credits') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.earned') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.grade') }}</th>
                    <th width="4%">{{ trans('cruds.extraction_report.fields.points') }}</th>
                </tr>
            </thead>
            <tbody class="extraction-report-inner">
                @if($receiverMappings && $receiverMappings->count() > 0)
                    @php                        
                        $totalBatch = $receiverMappings->count();
                        $i=0;
                    @endphp
                    @foreach($receiverMappings as $batchKey => $mappingBatch)
                        @php
                            ++$i;
                            $totallevel = $mappingBatch->count();
                            $totalReceiverCredits = 0;
                            $totalIssuerEarned = 0;
                            $totalIssuerCredits = 0;

                            $batchLevel = $mappingBatch->first()->level ?? "";

                            $schoolRef = (int)substr($batchLevel, 0, 1);
                        @endphp
                        @foreach($mappingBatch as $key => $record)
                            @php
                                $schoolRef += 0.01;
                                $receiverlevel = $record->level ?? "";
                                $totalReceiverCredits += $record->course_credits ?? 0.00;                                

                                $issuerCurriculumDetail = null;
                                $receiverEvaluationTemplateMapping = null;
                                $issuerExtractMapping = null;
                                if($record->receiverEvaluationTemplateMapping){
                                    $issuerCurriculumDetail = $record->receiverEvaluationTemplateMapping->issuerCurriculumDetail;
                                    if($issuerCurriculumDetail){
                                        $issuerExtractMapping = $issuerCurriculumDetail->issuerExtractTranscriptMapping()->where('extract_transcript_id',$extractTranscript->id)->first();   
                                        
                                        $issuerlevel = $issuerCurriculumDetail->levelMaster->title ?? "";
                                        $totalIssuerCredits += $issuerCurriculumDetail->course_credits ?? 0.00;
                                        
                                        $totalIssuerEarned += $issuerExtractMapping->earned ?? 0.00;
                                    }
                                }
                                
                            @endphp
                            <tr>
                                <td align="right">{{ sprintf('%0.2f', $schoolRef) }}</td>
                                <td align="right">{{ $receiverlevel }}</td>
                                <td >{{ $record->course_code ?? "" }}</td>
                                <td >{{ $record->course_name ?? "" }}</td>
                                <td align="right">{{ $record->course_credits ?? "" }}</td>

                                <td align="right">{{ ($issuerExtractMapping) ? sprintf('%0.2f', $schoolRef) : "" }}</td>
                                <td align="right">{{ ($issuerExtractMapping) ? $issuerlevel : "" }}</td>
                                <td>{{ ($issuerExtractMapping) ? $issuerCurriculumDetail->course_code : "" }}</td>
                                <td>{{ ($issuerExtractMapping) ? $issuerCurriculumDetail->course_name : "" }} </td>
                                <td align="right">{{ ($issuerExtractMapping) ? $issuerCurriculumDetail->course_credits : "" }}</td>
                                <td align="right">{{ $issuerExtractMapping->earned ?? "" }}</td>
                                <td align="right">{{ $issuerExtractMapping->grade ?? "" }}</td>
                                <td align="right">{{ $issuerExtractMapping->point ?? "" }}</td>                                
                            </tr>        
                        @endforeach

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
                            <td align="right"><b>{{ $receiverlevel ?? "" }}</b></td>
                            <td></td>
                            <td><b>Total {{ $receiverlevel ?? "" }} Level</b></td>
                            <td align="right"><b>{{ $totalReceiverCredits }}</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td align="right"><b>{{ $totalIssuerCredits }}</b></td>
                            <td align="right"><b>{{ $totalIssuerEarned }}</b></td>
                            <td></td>
                            <td></td>
                        </tr>

                        @if($i < $totalBatch)
                            <!-- blank row for next level -->  
                            <tr>
                                <td colspan="13" class="blank-column"></td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    @if(isset($pageNum) && $pageNum)
    <script type="text/php">
        if (isset($pdf)) {
            $tempName = "{{ $templateName ?? '' }}";
            $pageNoText = trans('panel.page')." {PAGE_NUM} / {PAGE_COUNT}";
            $size = 10;
            $font = $fontMetrics->getFont("sans-serif");
            $width = $fontMetrics->get_text_width($pageNoText, $font, $size) / 2 -13;
            $x = ($pdf->get_width() - $width);
            $y = $pdf->get_height() - 35;
            $pdf->page_text($x, $y, $pageNoText, $font, $size);
            $pdf->page_text(34, $y, $tempName, $font, $size);
        }
    </script>
    @endif

</section>