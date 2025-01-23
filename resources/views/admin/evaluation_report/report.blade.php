@extends('layouts.admin')
@section('title', $pageTitle)

<style>

    header.navbar.pcoded-header.navbar-expand-lg.navbar-light,
    .navbar-content,
    footer.footer,
    #pcoded-navbar,
    #pageloader {
        display: none !important;
    }

    


    .report-pdf {
        background: #fff;
        padding: 30px 0 ;
    }

    table th {
        text-align: left;
        font-size: 16px !important;
    }

    table td {
        font-size: 16px !important;
    }

    .logo-main img {
        max-width: 250px;
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
</style>
@section('content')
<section class="report-pdf">
    <table class="report-pdf-inner" cellspacing="0" cellpadding="0" width="100%">
        <tbody>
            <tr>
                <td>
                    <div class="logo-main">
                        <img src="{{ $logoImg }}" />
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <h2 class="heading-main">{{ trans('cruds.evaluation_report.title') }}</h2>
                </td>
            </tr>
            <tr>
                <td>
                    <p class="paragraph-content mt-10">Reviewed Credentials from <b>UAE</b> and Evaluated its <b>Nigeria</b> Equivalence (MLSCN)</p>
                </td>
            </tr>
            <tr>
                <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <th>{{ trans('cruds.evaluation_report.fields.current_name') }}</th>
                            <td>Khadija Mashi Rabiu </td>
                            <th>{{ trans('cruds.evaluation_report.fields.report_date') }}</th>
                            <td>06/04/2022</td>
                        </tr>
                        <tr>
                            <th>{{ trans('cruds.evaluation_report.fields.dob') }}</th>
                            <td>27/12/1999 </td>
                            <th>{{ trans('cruds.evaluation_report.fields.reference') }}</th>
                            <td>MLSCN/EDU/ATR/VOL.1/027/2021</td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <td>
                    <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.equivalency_summary.summary') }}</p>
                </td>
            </tr>
            <tr>
                <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <th>{{ trans('cruds.evaluation_report.equivalency_summary.mlscn') }}</th>
                            <th>{{ trans('cruds.evaluation_report.equivalency_summary.partial_equivalence') }}</th>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <td>
                    <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.credential_evaluation.title') }}</p>
                </td>
            </tr>
            <tr>
                <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.credential_evaluation.country') }}</td>
                            <td>UAE</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.credential_evaluation.issued_by') }}</td>
                            <td>University of Sharjah</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.credential_evaluation.credential_type') }}</td>
                            <td>Bachelors Certificate</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.credential_evaluation.credential_qualification') }}</td>
                            <td>Bachelor of Science in Medical Lab Science</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.credential_evaluation.evaluation_framework') }}</td>
                            <td>MLSCN - Bachelor in Medical Lab Science (BMLS)</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.credential_evaluation.nigeria_equivalence') }}</td>
                            <td>Partial Equivalence to Bachelors Degree</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.credential_evaluation.degree_equivalence') }}</td>
                            <td>Four Years Degree Course</td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <td>
                    <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.admission_assessment.title') }}</p>
                </td>
            </tr>
            <tr>
                <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.admission_assessment.undergraduate_admission') }}</td>
                            <td>Meet Admission Requirement</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.admission_assessment.notes') }}</td>
                            <td>
                                <ul style="margin:0 !important;">
                                    <li>5 O Level Credits include Maths and English</li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <td>
                    <p class="paragraph-content mt-10">Report Summary</p>
                </td>
            </tr>
            <tr>
                <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <td>Is the awarding foreign institution authorized in their country?</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Is the awarding foreign institution authorized to issue the specific course degree?</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Is the awarding foreign institution recognized by Nigeria?</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Is the information on the credential authentic and valid?</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Is the foreign degree comparable to what obtains in Nigeria?</td>
                            <td>No</td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <td>
                    <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.course_analysis.title') }}</p>
                </td>
            </tr>
            <tr>
                <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.course_analysis.specialization') }}</td>
                            <td>Medical Laboratory Science</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.course_analysis.course_type') }}</td>
                            <td>Bachelor's Degree Course</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.course_analysis.category') }}</td>
                            <td>Tertiary Education</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.course_analysis.admission_requirement') }}</td>
                            <td>Secondary School Certificates</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.course_analysis.program_duration_requirement') }}</td>
                            <td>8 Semester 4 Years</td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <td>
                    <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.holder_analysis.title') }}</p>
                </td>
            </tr>
            <tr>
                <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.holder_analysis.fullname_in_schoo') }}</td>
                            <td>Khadija Mashi Rabiu</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.holder_analysis.year_start') }}</td>
                            <td>2017</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.holder_analysis.year_end') }}</td>
                            <td>2021</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.holder_analysis.duration_spent') }}</td>
                            <td>4 Years</td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
                <td>
                    <p class="paragraph-content mt-10">{{ trans('cruds.evaluation_report.issuer_analysis.title') }}</p>
                </td>
            </tr>
            <tr>
                <table class="report-pdf-inner-content mt-10 mb-10" cellspacing="0" cellpadding="0" width="100%">
                    <tbody>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.issuer_analysis.country') }}</td>
                            <td>UAE</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.issuer_analysis.issuer_type') }}</td>
                            <td>Private University</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.issuer_analysis.issuer_accreditation_status') }}</td>
                            <td>Accredited</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.issuer_analysis.qualification_accreditation_body') }}</td>
                            <td>UAE Ministry of Higher Education</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.issuer_analysis.accredited_qualification') }}</td>
                            <td>Bachelor of Medical Laboratory Science</td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.issuer_analysis.issuer_website') }}</td>
                            <td><a href="">https://www.sharjah.ac.ae/</a></td>
                        </tr>
                        <tr>
                            <td>{{ trans('cruds.evaluation_report.issuer_analysis.issuer_location') }}</td>
                            <td>P. O. Box 27272 Sharjah, UAE</td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
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
                            <td>University of Sharjah</td>
                            <td>Holder Submitted</td>
                            <td>Verified</td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>Transcript of Academic Records</td>
                            <td>University of Sharjah</td>
                            <td>Holder Submitted</td>
                            <td>Verified</td>
                        </tr>
                        <tr>
                            <td>003</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
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
                            <td>Verified</td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
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
                            <td>MLSCN Framework for Bachelor In Medical Lab Science (BMLS)</td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td>NUC Ministry of Education Framework</td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
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
                            <td>Partial course coverage</td>
                        </tr>
                        <tr>
                            <td>002</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </tr>
            <tr>
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
                            <td>Glory Ekor</td>
                        </tr>
                        <tr>
                            <td>Signed</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>06/04/2022</td>
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

@endsection