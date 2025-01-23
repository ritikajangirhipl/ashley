<style type="text/css" scoped>  
    @page {
        margin: 20px 25px 80px 25px;   
        page-break-inside: avoid !important;     
    }
    /*table.second-page, table.second-page .report-pdf-inner-content{
        page-break-inside: avoid !important;
    }*/
    .report-pdf {
        background: #fff;
        /*padding: 30px 0 ;*/
    }
    table th {
        text-align: left;
        font-size: 16px !important;
    }
    table td {
        font-size: 16px !important;
    }
    .logo-main img {
        max-width: 150px;
    }
    .heading-main {
        color: #734BD2;
        font-size: 21px;
        font-weight: 700;
        margin: 25px 0;
    }
    .paragraph-content {
        color: #1B36FF;
        font-size: 16px;
        font-weight: normal !important;
        margin-bottom: 0;
    }
    .mt-10 {
        margin-top: 10px;
    }
    .paragraph-content b {
        color: #000;
        font-weight: 700;
    }
    .report-pdf-inner-content {
        border-top: 1px solid #FDE9D9;
        border-left: 1px solid #FDE9D9;
    }
    .report-pdf-inner-content tr th,
    .report-pdf-inner-content tr td {
        border-bottom: 1px solid #FDE9D9;
        padding: 8px 10px;
        border-right: 1px solid #FDE9D9;
        font-size: 15px;
    }
    .report-pdf-inner-content tr td {
        font-weight: normal !important;
    }
    .mb-10 {
        margin-bottom: 10px;
    }
    .report-pdf-inner-content ul {
        padding: 0 17px;
    }
    .note-content {
        font-size: 7px;
        font-weight: normal !important;
    }
    .text-danger {
        color: red;
    }
    div.header {
        position: fixed;
        top: -70px;
        left: 0px;
        right: 0px;
        font-size: 15px !important;        
        line-height: 35px;
        display: table;
        width: 100%;
    }

    div.footer {
        position: fixed; 
        bottom: -40px; 
        left: 0px; 
        right: 0px;
        font-size: 15px !important;
        line-height: 35px;
        display: table;
        width: 100%;
    }

    div.footer .page:after { 
        content: counter(page);
        float: right;
        margin-right: 0;
        margin-top: -10px;
        background: #fff;
        width: 36px;
        text-align: center;
    }
    .logo-short-right {
        width: 5%;
    }
    .header p, .logo-short-right {
        display: table-cell;
        vertical-align: bottom;
    }
    .header p{
        margin: 0;
        line-height: 24px;
        color: #000;
        border-bottom: 2px solid #000000;
    }
    .footer p{
        margin: 0;
        line-height: 18px;
        border-top: 1px solid #000000;
    }
    
</style>

<!-- Define header and footer blocks before your content -->
{{-- <div class="header">
    <p>studentmanagement.com/evaluation</p>
    <div class="logo-short-right">
        <img src="https://student.hipl-staging3.com/assets/admin/images/sm_logo_img.png">
    </div>
</div> --}}

<div class="footer">
    {{--<p class="page">{{ $holderSubmission->submission_ref ?? "" }} - {{ $holderSubmission->students->name ?? "" }} - {{ $holderSubmission->receiver_reference ?? '' }}</p>--}}
    <p class="page">{{ $holderSubmission->stage3->evaluationTemplate->name ?? "" }}</p>
</div>

<main>
    <section class="report-pdf">
        <div class="logo-main">
            <img src="{{ $logoImg }}" alt="Logo" />
        </div>
        <table class="report-pdf-inner first-page" cellspacing="0" cellpadding="0" width="100%">
            <tbody>
                <tr>
                    <td>
                        <h2 class="heading-main">{{ trans('cruds.evaluation_report.title') }}</h2>
                    </td>
                </tr>
                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">Reviewed Credentials from <b>{{ $holderSubmission->issuer->country->name ?? '' }}</b> and Evaluated its <b>{{ $holderSubmission->receiver->country->name ?? '' }}</b> Equivalence ({{ $holderSubmission->receiver->initial ?? '' }})</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <th>{{ trans('cruds.evaluation_report.fields.current_name') }}</th>
                                <td>{{ $holderSubmission->students->name ?? '' }} </td>
                                <th>{{ trans('cruds.evaluation_report.fields.report_date') }}</th>
                                <td>{{ date('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('cruds.evaluation_report.fields.dob') }}</th>
                                <td>{{ $holderSubmission->students->dob ? date('d/m/Y', strtotime($holderSubmission->students->dob)) : '' }} </td>
                                <th>{{ trans('cruds.evaluation_report.fields.reference') }}</th>
                                <td>{{ $holderSubmission->receiver_reference ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.equivalency_summary.summary') }}</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <th>
                                    <!-- <b>{{ $holderSubmission->receiver->country->name ?? '' }}</b>  -->
                                    Nigeria Equivalence ({{ $holderSubmission->receiver->initial ?? '' }})</th>
                                <th>{{ config('constant.holderSubmissionStages.performEvaluation.status')[$holderSubmission->stage5->nigeria ?? ''] }}</th>
                            </tr>
                        </tbody>
                    </table>
                </tr>
                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.credential_evaluation.title') }}</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.credential_evaluation.country') }}</td>
                                <td>{{ $holderSubmission->issuer->country->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.credential_evaluation.issued_by') }}</td>
                                <td>{{ $holderSubmission->issuer->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.credential_evaluation.credential_type') }}</td>
                                <td>
                                    {{ config('constant.enums.courseType')[$holderSubmission->issuerDegree->course_type ?? ''] }}
                                </td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.credential_evaluation.credential_qualification') }}</td>
                                <td>{{ $holderSubmission->issuerDegree->qualification ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.credential_evaluation.evaluation_framework') }}</td>
                                <td>{{ $holderSubmission->receiverDegree->qualification ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.credential_evaluation.nigeria_equivalence') }}</td>
                                <td>{{ config('constant.holderSubmissionStages.performEvaluation.status')[$holderSubmission->stage5->nigeria ?? ''] }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.credential_evaluation.degree_equivalence') }}</td>
                                <td>{{ config('constant.holderSubmissionStages.performEvaluation.degree_certificate_status')[$holderSubmission->stage5->degree ?? ''] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.admission_assessment.title') }}</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.admission_assessment.undergraduate_admission') }}</td>
                                <td>{{ $holderSubmission->stage5->undergraduate_admission ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.admission_assessment.notes') }}</td>
                                <td>
                                    <ul style="margin:0 !important;">
                                        <li>{{ $holderSubmission->stage5->admission_notes_1 ?? '' }}</li>
                                        <li>{{ $holderSubmission->stage5->admission_notes_2 ?? '' }}</li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
                
            </tbody>        
        </table>

        <table class="report-pdf-inner" cellspacing="0" cellpadding="0" width="100%">
            <tbody>               

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">Report Summary</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <td>Is the awarding foreign institution authorized in their country?</td>
                                <td>{{ config('constant.enums.accreditationStatus')[$holderSubmission->issuer->accreditation_status ?? ''] }}</td>
                            </tr>
                            <tr>
                                <td>Is the awarding foreign institution authorized to issue the specific course degree?</td>
                                <td>{{ config('constant.enums.accreditationStatus')[$holderSubmission->issuerDegree->accreditation_status ?? ''] }}</td>
                            </tr>
                            <tr>
                                <td>Is the awarding foreign institution recognized by Nigeria?</td>
                                <td>{{ config('constant.enums.recognitionStatus')[$holderSubmission->issuer->recognition_status ?? ''] }}</td>
                            </tr>
                            <tr>
                                <td>Is the information on the credential authentic and valid?</td>
                                <td>{{ $holderSubmission->stage4->is_verified ? "Yes" : "No" }}</td>
                            </tr>
                            <tr>
                                <td>Is the foreign degree comparable to what obtains in Nigeria?</td>
                                <td>{{ config('constant.holderSubmissionStages.status')[$holderSubmission->stage5->comparability ?? ''] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.course_analysis.title') }}</p>
                    </td>
                </tr>

                <tr class="row-heading">
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.course_analysis.specialization') }}</td>
                                <td>{{ $holderSubmission->issuerDegree->specialization ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.course_analysis.course_type') }}</td>
                                <td>{{ ucfirst($holderSubmission->issuerDegree->course_type) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.course_analysis.category') }}</td>
                                <td>Tertiary Education</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.course_analysis.admission_requirement') }}</td>
                                <td>
                                    <p>{{ $holderSubmission->issuerDegree->admission_requirement_1 ?? '' }}</p>
                                    <p>{{ $holderSubmission->issuerDegree->admission_requirement_2 ?? '' }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.course_analysis.program_duration_requirement') }}</td>
                                <td>{{ $holderSubmission->issuerDegree->program_length_required ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.holder_analysis.title') }}</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.holder_analysis.fullname_in_school') }}</td>
                                <td>{{ $holderSubmission->school_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.holder_analysis.year_start') }}</td>
                                <td>{{ $holderSubmission->start_year ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.holder_analysis.year_end') }}</td>
                                <td>{{ $holderSubmission->end_year ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.holder_analysis.duration_spent') }}</td>
                                <td>{{ $holderSubmission->end_year-$holderSubmission->start_year ?? '' }} Years</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
                
                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.issuer_analysis.title') }}</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <tbody>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.issuer_analysis.country') }}</td>
                                <td>{{ $holderSubmission->issuer->country->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.issuer_analysis.issuer_type') }}</td>
                                <td>{{ config('constant.enums.issuerType')[$holderSubmission->issuer->type ?? ''] }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.issuer_analysis.issuer_accreditation_status') }}</td>
                                <td>{{ $holderSubmission->issuer->accreditationBody->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.issuer_analysis.qualification_accreditation_body') }}</td>
                                <td>{{ $holderSubmission->issuerDegree->accreditationBody->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.issuer_analysis.accredited_qualification') }}</td>
                                <td>{{ $holderSubmission->issuerDegree->qualification ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.issuer_analysis.issuer_website') }}</td>
                                <td><a href="{{ $holderSubmission->issuer->website_url ?? '#' }}" target="blank">{{ $holderSubmission->issuer->website_url ?? '' }}</a></td>
                            </tr>
                            <tr>
                                <td>{{ trans('cruds.evaluation_report.issuer_analysis.issuer_location') }}</td>
                                <td>{{ $holderSubmission->issuer->address ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.credentials_evaluated.title') }}</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.evaluation_report.credentials_evaluated.ref') }}</th>
                                <th>{{ trans('cruds.evaluation_report.credentials_evaluated.credential_name') }}</th>
                                <th>{{ trans('cruds.evaluation_report.credentials_evaluated.issuer') }}</th>
                                <th>{{ trans('cruds.evaluation_report.credentials_evaluated.source') }}</th>
                                <th>{{ trans('cruds.evaluation_report.credentials_evaluated.verification') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Certificate - Bachelors</td>
                                <td>{{ $holderSubmission->issuer->name ?? "" }}</td>
                                <td>{{ config('constant.holderSubmissionStages.requestVerification.source')[$holderSubmission->stage2->degree_certificate_source ?? ''] }}</td>
                                <td>{{ config('constant.holderSubmissionStages.updateVerification.status')[$holderSubmission->stage4->update_degree_certificate_status ?? ''] }}</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>Transcript of Academic Records</td>
                                <td>{{ $holderSubmission->issuer->name ?? "" }}</td>
                                <td>{{ config('constant.holderSubmissionStages.requestVerification.source')[$holderSubmission->stage2->academic_transcript_source ?? ''] }}</td>
                                <td>{{ config('constant.holderSubmissionStages.updateVerification.status')[$holderSubmission->stage4->update_transcript_status ?? ''] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">Linked Credential Admission - Requirements Assessment</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Credential Name</th>
                                <th>Admissions</th>
                                <th>Qualification</th>
                                <th>Verification</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>WAEC</td>
                                <td>WAEC</td>
                                <td>WAEC</td>
                                <td>{{ config('constant.holderSubmissionStages.updateVerification.status')[$holderSubmission->stage4->update_o_level_certificate_status ?? ''] }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.curriculum_framework_references.title') }}</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.evaluation_report.curriculum_framework_references.ref') }}</th>
                                <th>{{ trans('cruds.evaluation_report.curriculum_framework_references.framework_name') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>MLSCN Framework for {{ $holderSubmission->receiverDegree->qualification ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>NUC Ministry of Education Framework</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.summary_observations.title') }}</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <thead>
                            <tr>
                                <th>{{ trans('cruds.evaluation_report.summary_observations.sn') }}</th>
                                <th>{{ trans('cruds.evaluation_report.summary_observations.observation') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>{{ $holderSubmission->stage5->summary_notes_1 ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>002</td>
                                <td>{{ $holderSubmission->stage5->summary_notes_2 ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>003</td>
                                <td>{{ $holderSubmission->stage5->summary_notes_3 ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>

                <tr class="row-heading">
                    <td>
                        <p class="paragraph-content mt-10">Evaluation Performed</p>
                    </td>
                </tr>
                <tr>
                    <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                        <thead>
                            <tr>
                                <th>Company</th>
                                <th>ETX Solutions Limited</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Department</td>
                                <td>Credentials Evaluations Unit</td>
                            </tr>
                            <tr>
                                <td>Head of Department</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Signed</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>{{ date('d/m/Y') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </tr>
                
                <tr>
                    <td>
                        <p class="note-content mt-10">NOTE: Report is expressed as an independent assessment based on international best practices and does not infer suitability of acceptance. Receivers reserve the right to make their own decisions</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</main>