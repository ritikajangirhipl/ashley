<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block" id="submission-process-content" style="display: none;">

                <div id="smartwizard" class="sw-main">
                    @php
                        $doneClass = "done";
                    @endphp
                    <ul class="nav nav-tabs step-anchor" id="steps-nav">
                        <li class="nav-item step-0 {{ (isset($holderSubmission) && $holderSubmission->is_stage1_completed) ? 'done': '' }}">
                            <a href="#submission-step-1" class="nav-link" data-repo="stage-1">
                                <h6>{{ trans('cruds.bill_verify_payments.title_singular') }}</h6>
                            </a>
                        </li>
                        <li class="nav-item step-1 {{ (isset($holderSubmission) && $holderSubmission->is_stage2_completed) ? 'done': '' }}">
                            <a href="#submission-step-2" class="nav-link" data-repo="stage-2">
                                <h6>{{ trans('cruds.request_verification.title_singular') }}</h6>
                            </a>
                        </li>
                        <li class="nav-item step-2 {{ (isset($holderSubmission) && $holderSubmission->is_stage3_completed) ? 'done': '' }}">
                            <a href="#submission-step-3" class="nav-link" data-repo="stage-3">
                                <h6>{{ trans('cruds.extract_transcript.title_singular') }}</h6>
                            </a>
                        </li>
                        <li class="nav-item step-3 {{ (isset($holderSubmission) && $holderSubmission->is_stage4_completed) ? 'done': '' }}">
                            <a href="#submission-step-4" class="nav-link" data-repo="stage-4">
                                <h6>{{ trans('cruds.update_verification.title_singular') }}</h6>
                            </a>
                        </li>
                        <li class="nav-item step-4 {{ (isset($holderSubmission) && $holderSubmission->is_stage5_completed) ? 'done': '' }}">
                            <a href="#submission-step-5" class="nav-link" data-repo="stage-5">
                                <h6>{{ trans('cruds.perform_evaluation.title_singular') }}</h6>
                            </a>
                        </li>
                        <li class="nav-item step-5 {{ (isset($holderSubmission) && $holderSubmission->is_stage6_completed) ? 'done': '' }}">
                            <a href="#submission-step-6" class="nav-link" data-repo="stage-6">
                                <h6>{{ trans('cruds.prepare_report.title_singular') }}</h6>
                            </a>
                        </li>
                        <li class="nav-item step-6 {{ (isset($holderSubmission) && $holderSubmission->is_stage7_completed) ? 'done': '' }}">
                            <a href="#submission-step-7" class="nav-link" data-repo="stage-7">
                                <h6>{{ trans('cruds.validate_report.title_singular') }}</h6>
                            </a>
                        </li>
                        <li class="nav-item step-7 {{ (isset($holderSubmission) && $holderSubmission->is_stage8_completed) ? 'done': '' }}">
                            <a href="#submission-step-8" class="nav-link" data-repo="stage-8">
                                <h6>{{ trans('cruds.deliver_report.title_singular') }}</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="sw-container tab-content">
                        <!-- Processing - Stage 1 - Bill and Verify Payments -->
                        <div class="step_main_content" id="submission-step-1" data-index="1">
                            <h5>{{ trans('cruds.bill_verify_payments.title_singular') }}</h5>
                            <hr class="mb-3">
                            <div class="row">
                                <div class="form-group col-md-12" id="amount_to_bill_box">
                                    <label for="bill_amount">{{ trans('cruds.bill_verify_payments.fields.bill_amount') }}<span class="required">*</span></label>
                                    {{ Form::number('bill_amount',old('bill_amount', $holderSubmission->fees_to_pay), ['class' => 'form-control','id'=>'bill_amount','placeholder'=>trans('cruds.bill_verify_payments.fields.bill_amount'),'required'=>'true', 'readonly'=>true]) }}
                                    <span class="bill_amount help-block text-danger"></span>
                                </div>  

                                <div class="form-group col-md-12">
                                    <label for="payment_status">{{ trans('cruds.bill_verify_payments.fields.payment_status') }}<span class="required">*</span></label>
                                    {{ Form::select('payment_status', config('constant.enums.paymentStatus'),old('payment_status', (isset($holderSubmission) && $holderSubmission->stage1) ? $holderSubmission->stage1->payment_status : null), ['class' => 'form-control select2','id'=>'payment_status','placeholder'=>trans('cruds.select_type',['attribute' => "payment status"]),'required'=>'true']) }}
                                    <span class="payment_status help-block text-danger"></span>
                                </div>

                                <div class="form-group col-md-12" id="paid_amount_box" 
                                    style="display: {{ (isset($holderSubmission) && $holderSubmission->stage1 && $holderSubmission->stage1->payment_status == 'not_paid') ? 'none' : 'block'}}">
                                    <label for="paid_amount">{{ trans('cruds.bill_verify_payments.fields.paid_amount') }}<span class="required">*</span></label>
                                    {{ Form::number('paid_amount',old('paid_amount', (isset($holderSubmission) && $holderSubmission->stage1) ? $holderSubmission->stage1->paid_amount : null), ['class' => 'form-control','id'=>'paid_amount','placeholder'=>trans('cruds.bill_verify_payments.fields.paid_amount'),'required'=>'true','min'=>"0"]) }}
                                    <span class="paid_amount help-block text-danger"></span>
                                </div>     

                                <div class="form-group col-md-12" id="payment_ref">
                                    <label for="payment_ref">{{ trans('cruds.bill_verify_payments.fields.payment_ref') }}<span class="required">*</span></label>
                                    {{ Form::text('payment_ref',old('payment_ref', (isset($holderSubmission) && $holderSubmission->stage1) ? $holderSubmission->stage1->payment_ref : null), ['class' => 'form-control','id'=>'payment_ref','placeholder'=>trans('cruds.bill_verify_payments.fields.payment_ref'),'required'=>'true']) }}
                                    <span class="payment_ref help-block text-danger"></span>
                                </div>                                
                            </div>
                        </div>

                        <!-- Processing - Stage 2 - Request Verification -->
                        <div class="step_main_content" id="submission-step-2" data-index="2">
                            <h5>{{ trans('cruds.request_verification.title_singular') }}</h5>
                            <hr class="mb-3">
                            <div class="row verification-type-box">
                                <div class="col-md-12">
                                    <table class="table table-bordered processing-stage table-responsive-md table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('cruds.request_verification.document') }}</th>
                                                <th>{{ trans('cruds.request_verification.source') }}</th>
                                                <th>{{ trans('cruds.request_verification.verification_outcome') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ trans('cruds.request_verification.fields.o_level_certificate') }}</td>
                                                <td>
                                                    {{ Form::select('o_level_certificate_source', config('constant.holderSubmissionStages.requestVerification.source'),old('o_level_certificate_source', (isset($holderSubmission) && $holderSubmission->stage2) ? $holderSubmission->stage2->o_level_certificate_source : null), ['class' => 'form-control select2','id'=>'o_level_certificate_source','placeholder'=>trans('cruds.select_type',['attribute' => "source"]),'required'=>'true']) }}
                                                    <span class="o_level_certificate_source help-block text-danger"></span>

                                                </td>
                                                <td>
                                                    {{ Form::select('o_level_certificate_status', config('constant.holderSubmissionStages.requestVerification.status'),old('o_level_certificate_status', (isset($holderSubmission) && $holderSubmission->stage2) ? $holderSubmission->stage2->o_level_certificate_status : null), ['class' => 'form-control select2','id'=>'o_level_certificate_status','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="o_level_certificate_status help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>{{ trans('cruds.request_verification.fields.degree_certificate') }}</td>
                                                <td>
                                                    {{ Form::select('degree_certificate_source', config('constant.holderSubmissionStages.requestVerification.source'),old('degree_certificate_source', (isset($holderSubmission) && $holderSubmission->stage2) ? $holderSubmission->stage2->degree_certificate_source : null), ['class' => 'form-control select2','id'=>'degree_certificate_source','placeholder'=>trans('cruds.select_type',['attribute' => "source"]),'required'=>'true']) }}
                                                    <span class="degree_certificate_source help-block text-danger"></span>
                                                </td>
                                                <td>
                                                    {{ Form::select('degree_certificate_status', config('constant.holderSubmissionStages.requestVerification.status'),old('degree_certificate_status', (isset($holderSubmission) && $holderSubmission->stage2) ? $holderSubmission->stage2->degree_certificate_status : null), ['class' => 'form-control select2','id'=>'degree_certificate_status','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="degree_certificate_status help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>{{ trans('cruds.request_verification.fields.academic_transcript') }}</td>
                                                <td>
                                                    {{ Form::select('academic_transcript_source', config('constant.holderSubmissionStages.requestVerification.source'),old('academic_transcript_source', (isset($holderSubmission) && $holderSubmission->stage2) ? $holderSubmission->stage2->academic_transcript_source : null), ['class' => 'form-control select2','id'=>'academic_transcript_source','placeholder'=>trans('cruds.select_type',['attribute' => "source"]),'required'=>'true']) }}
                                                    <span class="academic_transcript_source help-block text-danger"></span>
                                                </td>
                                                <td>
                                                    {{ Form::select('academic_transcript_status', config('constant.holderSubmissionStages.requestVerification.status'),old('academic_transcript_status', (isset($holderSubmission) && $holderSubmission->stage2) ? $holderSubmission->stage2->academic_transcript_status : null), ['class' => 'form-control select2','id'=>'academic_transcript_status','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="academic_transcript_status help-block text-danger"></span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>                                    
                            </div>
                        </div>

                        <!-- Processing - Stage 3 - Extract Transcript -->
                        <div class="step_main_content" id="submission-step-3" data-index="3">
                            <h5>{{ trans('cruds.extract_transcript.title_singular') }}</h5>
                            <hr class="mb-3">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="evaluation_template_id">{{ trans('cruds.extract_transcript.fields.evaluation_template_id') }}<span class="required">*</span></label>
                                    {{ Form::select('evaluation_template_id', $evaluationTemplate ,old('evaluation_template_id', (isset($holderSubmission) && $holderSubmission->stage3) ? $holderSubmission->stage3->evaluation_template_id : null), ['class' => 'form-control select2','id'=>'evaluation_template_id','placeholder'=>trans('cruds.select_type',['attribute' => "evaluation template"]),'required'=>'true']) }}
                                    <span class="evaluation_template_id help-block text-danger"></span>
                                </div>
                                <div class="col-md-12" id="template-mapping-content">
                                    @if(isset($holderSubmission) && $holderSubmission->stage3)
                                        @include('admin.processing_submissions.partials._template_mappings',['mappings'=>$mappings])
                                    @endif
                                </div> 
                            </div>
                                <div class="row">
                                    <div class="col-md-12 text-right" id="generate-extraction-report-step3-block">
                                        <button class="btn btn-primary generate-extraction-pdf m-0" id="generate-extraction-pdf-step3">
                                            @if(isset($holderSubmission) && $holderSubmission->stage3 && $holderSubmission->stage3->is_report_generated)
                                                Regenerate and Preview Report
                                            @else
                                                Generate and Preview Report
                                            @endif                                    
                                        </button>
                                    </div>
                                </div>  
                        </div>

                        <!-- Processing - Stage 4 - Update Verification -->
                        <div class="step_main_content" id="submission-step-4" data-index="4">
                            <h5>{{ trans('cruds.update_verification.title_singular') }}</h5>
                            <hr class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-responsive-md table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('cruds.update_verification.document') }}</th>
                                                <th>{{ trans('cruds.update_verification.source') }}</th>
                                                <th>{{ trans('cruds.update_verification.verification_outcome') }}</th>
                                                <th>{{ trans('cruds.update_verification.fields.verification_status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ trans('cruds.update_verification.fields.o_level_certificate') }}</td>
                                                <td>

                                                    {{ Form::select('update_o_level_certificate_source', config('constant.holderSubmissionStages.requestVerification.source'),null, ['class' => 'form-control update_o_level_certificate_source','id'=>'update_o_level_certificate_source','placeholder'=>trans('cruds.select_type',['attribute' => "source"]),'required'=>'true','disabled'=>true]) }}
                                                    <span class="update_o_level_certificate_source help-block text-danger"></span>
                                                    <input type="hidden" class="update_o_level_certificate_source" name="update_o_level_certificate_source" value="">
                                                </td>
                                                <td>
                                                    {{ Form::select('update_o_level_certificate_status', config('constant.holderSubmissionStages.updateVerification.status'),old('update_o_level_certificate_status', (isset($holderSubmission) && $holderSubmission->stage4) ? $holderSubmission->stage4->update_o_level_certificate_status : null), ['class' => 'form-control select2','id'=>'update_o_level_certificate_status','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="update_o_level_certificate_status help-block text-danger"></span>
                                                </td>
                                                <td>
                                                    {{ Form::select('o_level_verification_status', config('constant.holderSubmissionStages.status'),old('o_level_verification_status', (isset($holderSubmission) && $holderSubmission->stage4) ? $holderSubmission->stage4->o_level_verification_status : null), ['class' => 'form-control select2','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="o_level_verification_status help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>{{ trans('cruds.update_verification.fields.degree_certificate') }}</td>
                                                <td>
                                                    {{ Form::select('update_degree_certificate_source', config('constant.holderSubmissionStages.requestVerification.source'),null, ['class' => 'form-control update_degree_certificate_source','id'=>'update_degree_certificate_source','placeholder'=>trans('cruds.select_type',['attribute' => "source"]),'required'=>'true','disabled'=>true]) }}
                                                    <span class="update_degree_certificate_source help-block text-danger"></span>
                                                    <input type="hidden" class="update_degree_certificate_source" name="update_degree_certificate_source" value="">
                                                </td>
                                                <td>
                                                    {{ Form::select('update_degree_certificate_status', config('constant.holderSubmissionStages.updateVerification.status'),old('update_degree_certificate_status', (isset($holderSubmission) && $holderSubmission->stage4) ? $holderSubmission->stage4->update_degree_certificate_status : null), ['class' => 'form-control select2','id'=>'update_degree_certificate_status','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="update_degree_certificate_status help-block text-danger"></span>
                                                </td>
                                                <td>
                                                    {{ Form::select('degree_verification_status', config('constant.holderSubmissionStages.status'),old('degree_verification_status', (isset($holderSubmission) && $holderSubmission->stage4) ? $holderSubmission->stage4->degree_verification_status : null), ['class' => 'form-control select2','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="degree_verification_status help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>{{ trans('cruds.update_verification.fields.academic_transcript') }}</td>
                                                <td>
                                                    {{ Form::select('update_transcript_source', config('constant.holderSubmissionStages.requestVerification.source'),null, ['class' => 'form-control update_transcript_source','id'=>'update_transcript_source','placeholder'=>trans('cruds.select_type',['attribute' => "source"]),'required'=>'true','disabled'=>true]) }}
                                                    <span class="update_transcript_source help-block text-danger"></span>
                                                    <input type="hidden" class="update_transcript_source" name="update_transcript_source" value="">
                                                </td>
                                                <td>
                                                    {{ Form::select('update_transcript_status', config('constant.holderSubmissionStages.updateVerification.status'),old('update_transcript_status', (isset($holderSubmission) && $holderSubmission->stage4) ? $holderSubmission->stage4->update_transcript_status : null), ['class' => 'form-control select2','id'=>'update_transcript_status','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="update_transcript_status help-block text-danger"></span>
                                                </td>
                                                <td>
                                                    {{ Form::select('transcript_verification_status', config('constant.holderSubmissionStages.status'),old('transcript_verification_status', (isset($holderSubmission) && $holderSubmission->stage4) ? $holderSubmission->stage4->transcript_verification_status : null), ['class' => 'form-control select2','placeholder'=>trans('cruds.select_type',['attribute' => "status"]),'required'=>'true']) }}
                                                    <span class="transcript_verification_status help-block text-danger"></span>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>                                 
                            </div>                            
                        </div>

                        <!-- Processing - Stage 5 - Perform Evaluation -->
                        <div class="step_main_content" id="submission-step-5" data-index="5">
                            <h5>{{ trans('cruds.perform_evaluation.title_singular') }}</h5>
                            <hr class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-responsive-md table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>{{ trans('cruds.perform_evaluation.fields.detail') }}</th>
                                                <th>{{ trans('cruds.perform_evaluation.fields.value') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><label for="nigeria">{{ trans('cruds.perform_evaluation.fields.nigeria') }}<span class="required">*</span></label></td>
                                                <td>
                                                    {{ Form::select('nigeria', config('constant.holderSubmissionStages.performEvaluation.status'),old('nigeria', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->nigeria : null), ['class' => 'form-control select2','id'=>'nigeria','placeholder'=>trans('cruds.select_type',['attribute' => "o nigeria"]),'required'=>'true']) }}
                                                    <span class="nigeria help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="degree">{{ trans('cruds.perform_evaluation.fields.degree') }}<span class="required">*</span></label></td>
                                                <td>
                                                    {{ Form::select('degree', config('constant.holderSubmissionStages.performEvaluation.degree_certificate_status'),old('degree', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->degree : null), ['class' => 'form-control select2','id'=>'degree','placeholder'=>trans('cruds.select_type',['attribute' => "degree"]),'required'=>'true']) }}
                                                    <span class="degree help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="comparability">{{ trans('cruds.perform_evaluation.fields.comparability') }}<span class="required">*</span></label></td>
                                                <td>
                                                    {{ Form::select('comparability', config('constant.holderSubmissionStages.status'),old('comparability', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->comparability : null), ['class' => 'form-control select2','id'=>'comparability','placeholder'=>trans('cruds.select_type',['attribute' => "comparability"]),'required'=>'true']) }}
                                                    <span class="comparability help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="undergraduate_admission">{{ trans('cruds.perform_evaluation.fields.undergraduate_admission') }}<span class="required">*</span></label></td>
                                                <td>
                                                    {{ Form::text('undergraduate_admission',old('undergraduate_admission', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->undergraduate_admission : null), ['class' => 'form-control','id'=>'undergraduate_admission','placeholder'=>trans('cruds.perform_evaluation.fields.undergraduate_admission'),'required'=>'true']) }}
                                                    <span class="undergraduate_admission help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="admission_notes_1">{{ trans('cruds.perform_evaluation.fields.admission_notes_1') }}<span class="required">*</span></label></td>
                                                <td>
                                                    {{ Form::text('admission_notes_1',old('admission_notes_1', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->admission_notes_1 : null), ['class' => 'form-control','id'=>'admission_notes_1','placeholder'=>trans('cruds.perform_evaluation.fields.admission_notes_1'),'required'=>'true']) }}
                                                    <span class="admission_notes_1 help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="admission_notes_2">{{ trans('cruds.perform_evaluation.fields.admission_notes_2') }}</label></td>
                                                <td>
                                                    {{ Form::text('admission_notes_2',old('admission_notes_2', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->admission_notes_2 : null), ['class' => 'form-control','id'=>'admission_notes_2','placeholder'=>trans('cruds.perform_evaluation.fields.admission_notes_2'),'required'=>'false']) }}
                                                    <span class="admission_notes_2 help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="summary_notes_1">{{ trans('cruds.perform_evaluation.fields.summary_notes_1') }}<span class="required">*</span></label></td>
                                                <td>
                                                    {{ Form::text('summary_notes_1',old('summary_notes_1', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->summary_notes_1 : null), ['class' => 'form-control','id'=>'summary_notes_1','placeholder'=>trans('cruds.perform_evaluation.fields.summary_notes_1'),'required'=>'true']) }}
                                                    <span class="summary_notes_1 help-block text-danger"></span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><label for="summary_notes_2">{{ trans('cruds.perform_evaluation.fields.summary_notes_2') }}</label></td>
                                                <td>
                                                    {{ Form::text('summary_notes_2',old('summary_notes_2', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->summary_notes_2 : null), ['class' => 'form-control','id'=>'summary_notes_2','placeholder'=>trans('cruds.perform_evaluation.fields.summary_notes_2'),'required'=>'false']) }}
                                                    <span class="summary_notes_2 help-block text-danger"></span>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td><label for="summary_notes_3">{{ trans('cruds.perform_evaluation.fields.summary_notes_3') }}</label></td>
                                                <td>
                                                    {{ Form::text('summary_notes_3',old('summary_notes_3', (isset($holderSubmission) && $holderSubmission->stage5) ? $holderSubmission->stage5->summary_notes_3 : null), ['class' => 'form-control','id'=>'summary_notes_3','placeholder'=>trans('cruds.perform_evaluation.fields.summary_notes_3'),'required'=>'false']) }}
                                                    <span class="summary_notes_3 help-block text-danger"></span>
                                                </td>
                                            </tr>                                            
                                            
                                        </tbody>
                                    </table>

                                    <div class="col-md-12 text-right" id="generate-extraction-report-step5-block">
                                        <button class="btn btn-primary generate-extraction-pdf m-0" id="generate-extraction-pdf-step5">
                                            Generate and Preview Report                                            
                                        </button>
                                    </div>
                                </div>                                
                            </div>
                        </div>

                        <!-- Processing - Stage 6 - Prepare Report -->
                        <div class="step_main_content" id="submission-step-6" data-index="6">
                            <h5>{{ trans('cruds.prepare_report.title_singular') }}</h5>
                            <hr class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-responsive-md table-responsive-sm">
                                      <thead>
                                        <tr>
                                          <th scope="col">Report</th>
                                          <th scope="col">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @php
                                           $isEvaluationReportGenerated = isset($holderSubmission) && $holderSubmission->stage6 ? $holderSubmission->stage6->is_evaluation_report_generated : 0;
                                           $isExtractionReportGenerated = isset($holderSubmission) && $holderSubmission->stage6 ? $holderSubmission->stage6->is_extraction_report_generated : 0;
                                           $isBothMerge = isset($holderSubmission) && $holderSubmission->stage6 ? $holderSubmission->stage6->is_both_merge : 0;
                                        @endphp
                                        <tr>
                                          <th scope="row">{{ trans('cruds.prepare_report.fields.evaluation_report') }}</th>
                                          <td>
                                                <button class="btn btn-primary btn-sm" id="generate-evaluation-pdf">{{ ($isEvaluationReportGenerated) ? 'Regenerate' : 'Generate'}}
                                                </button>

                                                <a href="{{ ($isEvaluationReportGenerated) ? asset('storage/'.$holderSubmission->stage6->evaluation_report_name) : ''}}" class="btn btn-dark btn-sm {{(!$isEvaluationReportGenerated) ? 'disabled' : ''}}" id="view-evaluation-report" target="_blank">{{ trans('global.view') }}</a>
                                          </td>
                                        </tr>
                                        <tr>
                                          <th scope="row">{{ trans('cruds.prepare_report.fields.extraction_report') }}</th>
                                          <td>
                                                <button class="btn btn-primary btn-sm generate-extraction-pdf" id="generate-extraction-pdf-step5">{{ ($isExtractionReportGenerated) ? 'Regenerate' : 'Generate'}}
                                                </button>

                                                <a href="{{ ($isExtractionReportGenerated) ? asset('storage/'.$holderSubmission->stage6->extraction_report_name) : ''}}" class="btn btn-dark btn-sm {{(!$isExtractionReportGenerated) ? 'disabled' : ''}}" id="view-extraction-report" target="_blank">{{ trans('global.view') }}</a>
                                          </td>
                                        </tr>
                                        <tr>
                                          <th scope="row">{{ trans('cruds.prepare_report.fields.merge_report') }}</th>
                                          <td>
                                                <button class="btn btn-primary btn-sm" id="merge-pdf" {{ ($isEvaluationReportGenerated && $isExtractionReportGenerated) ? '' : 'disabled' }}>{{ ($isBothMerge) ? 'Regenerate' : 'Generate'}}
                                                </button>
                                                <a href="{{ ($isBothMerge) ? asset('storage/'.$holderSubmission->stage6->merge_report_name) : ''}}" class="btn btn-dark btn-sm {{(!$isBothMerge) ? 'disabled' : ''}}" id="view-merged-report" target="_blank">{{ trans('global.view') }}</a>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                </div>
                            </div>                            
                        </div>

                        <!-- Processing - Stage 7 - Validate Report -->
                        <div class="step_main_content" id="submission-step-7" data-index="7">
                            <h5>{{ trans('cruds.validate_report.title_singular') }}</h5>
                            <hr class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="embed-responsive embed-responsive-16by9">
                                      <iframe class="embed-responsive-item" id="preview-merge-report" src="{{ (isset($holderSubmission) && $holderSubmission->stage6 && $holderSubmission->stage6->merge_report_name) ? asset('storage/'.$holderSubmission->stage6->merge_report_name) : null }}" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <div class="mt-3 col-md-12">
                                    <a id="download-merge-report" href="{{ (isset($holderSubmission) && $holderSubmission->stage6 && $holderSubmission->stage6->merge_report_name) ? asset('storage/'.$holderSubmission->stage6->merge_report_name) : '' }}" class="btn btn-primary w-100" download>{{ trans('cruds.validate_report.fields.download_document') }}</a>
                                </div>
                            </div>                             
                        </div>

                        <!-- Processing - Stage 8 - Deliver Report -->
                        <div class="step_main_content" id="submission-step-8" data-index="8">
                            <h5>{{ trans('cruds.deliver_report.title_singular') }}</h5>
                            <hr class="mb-3">     
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- add more recipent -->
                                    @php
                                        $recipentCounter = 0;
                                        if(isset($holderSubmission) && $holderSubmission->stage8 && $holderSubmission->stage8->is_stage8_completed && $holderSubmission->stage8->deliverReportReceivers->count() > 0){
                                            $recipentCounter = $holderSubmission->stage8->deliverReportReceivers->max('id');
                                            $recipentCounter += 1;
                                        }
                                    @endphp
                                    <div class="text-right">
                                        <div onclick="addRecipentBox()" id="addPersons" class="add_row" data-counter="{{ $recipentCounter ?? 0 }}" title="Add Recipent">
                                            <i class="fa fa-plus btn btn-primary"></i>
                                        </div>  
                                    </div>

                                    <table class="table table-bordered table-responsive-md table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ trans('cruds.deliver_report.fields.recipent_name') }}</th>
                                                <th scope="col">{{ trans('cruds.deliver_report.fields.email') }}</th>
                                                <th scope="col">{{ trans('global.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody class="recipent-details">  
                                            @if(isset($holderSubmission) && $holderSubmission->stage8 && $holderSubmission->stage8->is_stage8_completed && $holderSubmission->stage8->deliverReportReceivers->count() > 0)
                                                @foreach($holderSubmission->stage8->deliverReportReceivers as $key => $record)
                                                    <tr class="repeatable-recipent recipent-{{ $record->id }} recipent-row" data-row="{{ $record->id }}">
                                                        <td>
                                                           {{ Form::text('recipent['.$record->id.'][name]',$record->recipent_name, ['class' => 'form-control recipent_name','id'=>'recipent_name_'.$record->id,'placeholder'=>trans('cruds.deliver_report.fields.recipent_name'),'required'=>'true']) }} 
                                                           <span class="recipent_name_{{ $record->id }} help-block text-danger"></span>
                                                        </td>
                                                        <td>
                                                            {{ Form::email('recipent['.$record->id.'][email]',$record->recipent_email, ['class' => 'form-control recipent_email','id'=>'recipent_email_'.$record->id,'placeholder'=>trans('cruds.deliver_report.fields.email'),'required'=>'true','autocomplete' => 'off']) }} 
                                                            <span class="recipent_email_{{ $record->id }} help-block text-danger"></span>
                                                        </td>
                                                        <td>
                                                            <a href="javascript:void(0);" class="del-btn delete_record" title="Remove Recipent" data-url="{{ route('admin.processingSubmissions.deleteReportRecipent',$record->id) }}" data-recipent="recipent-{{ $record->id }}">
                                                                <i class="fa fa-minus btn btn-sm btn-danger"></i>
                                                            </div>  
                                                        </td>
                                                        <input type="hidden" class="recipent_id" id="recipent_id_{{ $record->id }}" name="recipent[{{ $record->id }}][deliver_report_receiver_id]" value="{{ $record->id }}">
                                                    </tr>     
                                                @endforeach
                                            @else                                                
                                                <tr class="repeatable-recipent recipent-0 recipent-row" data-row="0">
                                                    <td>
                                                       {{ Form::text('recipent[0][name]',null, ['class' => 'form-control recipent_name','id'=>'recipent_name_0','placeholder'=>trans('cruds.deliver_report.fields.recipent_name'),'required'=>'true']) }} 
                                                       <span class="recipent_name_0 help-block text-danger"></span>
                                                    </td>
                                                    <td>
                                                        {{ Form::email('recipent[0][email]',null, ['class' => 'form-control recipent_email','id'=>'recipent_email_0','placeholder'=>trans('cruds.deliver_report.fields.email'),'required'=>'true','autocomplete' => 'off']) }} 
                                                        <span class="recipent_email_0 help-block text-danger"></span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);" class="del-btn del_recipent" title="Remove Recipent" data-recipent="recipent-0">
                                                            <i class="fa fa-minus btn btn-sm btn-danger"></i>
                                                        </a>
                                                    </td>
                                                </tr>                                            
                                            @endif                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>