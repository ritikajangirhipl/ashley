<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HolderSubmission\StoreRequest;
use App\Http\Requests\HolderSubmission\UpdateRequest;
use App\Http\Requests\HolderSubmission\UpdateStepsRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\DataTables\ProcessingSubmissionsDataTable;
use App\Models\HolderSubmission;
use App\Models\Issuer;
use App\Models\Receiver;
use App\Models\Uploads;
use App\Models\Student;
use App\Models\EvaluationTemplate;
use App\Models\VerifyPayment;
use App\Models\RequestVerification;
use App\Models\ExtractTranscript;
use App\Models\ExtractTranscriptMapping;
use App\Models\UpdateVerification;
use App\Models\PerformEvaluation;
use App\Models\PrepareReport;
use App\Models\EvaluationTemplateMapping;
use App\Models\ValidateReport;
use App\Models\DeliverReport;
use App\Models\DeliverReportReceiver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PDF;
use Auth;
use Gate;
use Validator;
use Mail;
use App\Mail\SubmissionReportDeliver;
use App\Mail\SubmissionStageChangedMail;

class ProcessingSubmissionsController extends Controller
{
    private $status;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status   =   config('constant.enums.status');
        $this->folder   =   'processingsubmission';
    }

    public function index(ProcessingSubmissionsDataTable $dataTable)
    {
        abort_if(Gate::denies('processing_submission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.processing_submissions.list');
        return $dataTable->render('admin.processing_submissions.index', compact('pageTitle'));
    }

    
    public function show(HolderSubmission $holderSubmission)
    {
        abort_if(Gate::denies('processing_submission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.processing_submissions.show');
        $status    = $this->status;
        $goToStep  = str_replace('stage_', '', $holderSubmission->current_stage)-1;
        if($goToStep >= 8){
            $goToStep = 7;
        }else if($goToStep < 0){
            $goToStep = 0;
        }
        $mappings = null;
        if($holderSubmission->stage3){
            $extractTranscript = $holderSubmission->stage3;
            $mappings   = $this->getCurriculumDetailsQuery($extractTranscript->evaluation_template_id,$extractTranscript,false,"getMappings")->groupBy('course_name')->get();
        }
        $evaluationTemplate  = EvaluationTemplate::where('issuer_id',$holderSubmission->issuer_id)->where('receiver_id',$holderSubmission->receiver_id)->get()->pluck('name', 'id');
        return view('admin.processing_submissions.show', compact('holderSubmission','pageTitle','status','goToStep','evaluationTemplate','mappings'));
    }

    /**
     * [generateEvaluationReport description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function generateEvaluationReport(Request $request, HolderSubmission $holderSubmission){
        $logoImg    = asset('assets/admin/images/logo_full_img.png');
        try {
            $pdf = PDF::setOptions(['defaultFont' => 'sans-serif','enable_php' => true,'enable_remote' => true, 'chroot'  => public_path('/')]);

            // $holderSubmission = $holderSubmission->with(['stage1','stage2','stage3','stage4','stage5','stage6','stage8','issuer','receiver','students','issuerDegree','receiverDegree'])->first();
            
            $pdfView    = $pdf->loadView('admin.processing_submissions.reports.evaluation_report', compact('logoImg', 'holderSubmission'));

            $folderPath = $this->folder.'_pdf/';
            if (Storage::exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }
            $filePath   = $this->folder.'_pdf/'.rand().'_evaluationReport.pdf';
            Storage::disk('public')->put($filePath, $pdfView->output());
            $prepareReport = PrepareReport::updateOrCreate(
                ['holder_submission_id' =>  $holderSubmission->id],
                [
                    'holder_submission_id'          => $holderSubmission->id,
                    'evaluation_report_name'        => $filePath,
                    'is_evaluation_report_generated'=> 1,
                ]
            );
            $response = [
                'pdf_url'    => asset('storage/'.$filePath),
                'status'    => true,
                'message'   => trans('cruds.prepare_report.fields.evaluation_report').' '.trans('messages.generate_success_message'),
            ];
        } catch (\Exception $e) {
            $response = [
                'pdf_url'    => "",
                'status'    => false,
                'message'   => $e->getMessage(),
            ];
        }        
        return response()->json($response);
    }

    /**
     * [generateExtractionReport description]
     * @param  Request          $request          [description]
     * @param  HolderSubmission $holderSubmission [description]
     * @return [type]                             [description]
     */
    public function generateExtractionReport(Request $request, HolderSubmission $holderSubmission){
        $logoImg    = asset('assets/admin/images/logo_full_img.png');
        try {
            $mappingsRecords = null;
            if($request->current_step == 3){
                $extractTranscript = $this->saveExtractTranscriptData($holderSubmission, $request);
            }else{
                $extractTranscript = $holderSubmission->stage3;
            }
            if($extractTranscript){
                $templateName = $extractTranscript->evaluationTemplate->name ?? "";

                $issuerMappings   = $this->getCurriculumDetailsQuery($extractTranscript->evaluation_template_id,$extractTranscript);


                $issuerMappings   = $issuerMappings->with(['issuerEvaluationTemplateMapping','issuerEvaluationTemplateMapping.receiverCurriculumDetail'])
                    ->orderBy('earned','DESC')
                    ->get(); 

                // Get duplicate courses
                $duplicateRecords = $this->getCurriculumDetailsQuery($extractTranscript->evaluation_template_id,null,$duplicate=true);
                $duplicateCourses =  $duplicateRecords->whereNotIn('curriculum_details.id',$issuerMappings->pluck('issuer_curriculum_details_id'))->get();                

                $issuerMappings   = $issuerMappings->groupBy('level');

                $receiverMappings   = $this->getReceiversCurriculumDetailsQuery($extractTranscript->evaluation_template_id,$extractTranscript);
                $receiverMappings   = $receiverMappings->with(['receiverEvaluationTemplateMapping' => function ($q) use($extractTranscript) {
                        $q->where('evaluation_template_id', $extractTranscript->evaluation_template_id);
                    }])   
                ->get()
                ->sortBy(function($value){
                    return (int) $value->level ?? "0";
                })
                ->groupBy('level');        
                
                $pdfView    = PDF::loadView('admin.processing_submissions.reports.extraction_report', compact('logoImg', 'holderSubmission','extractTranscript','issuerMappings','receiverMappings','duplicateCourses','templateName'))->setOptions(['defaultFont' => 'sans-serif','enable_php' => true,'enable_remote' => true, 'chroot'  => public_path('/')]);

                $folderPath = $this->folder.'_pdf/';
                if (Storage::exists($folderPath)) {
                    Storage::disk('public')->makeDirectory($folderPath);
                }
                $filePath   = $this->folder.'_pdf/'.rand().'_extractionReport.pdf';
                Storage::disk('public')->put($filePath, $pdfView->output());
                if($request->current_step == 3){
                    $extractTranscript->update(['is_report_generated' => 1,'report_name' => $filePath]);
                }else{                
                    $prepareReport = PrepareReport::updateOrCreate(
                        ['holder_submission_id' =>  $holderSubmission->id],
                        [
                            'holder_submission_id'          => $holderSubmission->id,
                            'extraction_report_name'        => $filePath,
                            'is_extraction_report_generated'=> 1,
                        ]
                    );
                }

                $response = [
                    'pdf_url'       => asset('storage/'.$filePath),
                    'status'        => true,
                    'message'       => trans('cruds.prepare_report.fields.extraction_report').' '.trans('messages.generate_success_message'),
                ];
            }else{
                $response = [
                    'pdf_url'       => "",
                    'status'        => false,
                    'message'       => "Please fill stage 3 form.",
                ];
            }
           
        } catch (\Exception $e) {
            $response = [
                'pdf_url'    => "",
                'status'    => false,
                'message'   => $e->getMessage(),
            ];
        }        
        return response()->json($response);
    }

    public function mergeReport(Request $request, HolderSubmission $holderSubmission){
        $logoImg    = asset('assets/admin/images/logo_full_img.png');
        try {
            $mappingsRecords = null;
            if($holderSubmission->stage3){
                // $holderSubmission = $holderSubmission->with(['stage1','stage2','stage3','stage4','stage5','stage6','stage7','stage8','issuer','receiver','students','issuerDegree','receiverDegree'])->first();

                $extractTranscript = $holderSubmission->stage3;
                $templateName = $extractTranscript->evaluationTemplate->name ?? "";

                $issuerMappings   = $this->getCurriculumDetailsQuery($extractTranscript->evaluation_template_id,$extractTranscript);


                $issuerMappings   = $issuerMappings->orderBy('earned','DESC')->get();  

                // Get duplicate courses
                $duplicateRecords = $this->getCurriculumDetailsQuery($extractTranscript->evaluation_template_id,null,$duplicate=true);
                $duplicateCourses =  $duplicateRecords->whereNotIn('curriculum_details.id',$issuerMappings->pluck('issuer_curriculum_details_id'))->get();                

                $issuerMappings   = $issuerMappings->groupBy('level'); // group by levels

                $receiverMappings   = $this->getReceiversCurriculumDetailsQuery($extractTranscript->evaluation_template_id,$extractTranscript);
                $receiverMappings   = $receiverMappings->with(['receiverEvaluationTemplateMapping' => function ($q) use($extractTranscript) {
                        $q->where('evaluation_template_id', $extractTranscript->evaluation_template_id);
                    }])   
                ->get()
                ->sortBy(function($value){
                    return (int) $value->level ?? "0";
                })
                ->groupBy('level');             
            }
            $pdfView    = PDF::loadView('admin.processing_submissions.reports.merge_report', compact('logoImg', 'holderSubmission','extractTranscript','issuerMappings','receiverMappings','duplicateCourses','templateName'))->setOptions(['defaultFont' => 'sans-serif','enable_php' => true,'enable_remote' => true, 'chroot'  => public_path('/')]);

            $folderPath = $this->folder.'_pdf/';
            if (Storage::exists($folderPath)) {
                Storage::disk('public')->makeDirectory($folderPath);
            }
            $filePath   = $this->folder.'_pdf/'.rand().'_mergedReport.pdf';
            Storage::disk('public')->put($filePath, $pdfView->output());

            $prepareReport = PrepareReport::updateOrCreate(
                ['holder_submission_id' =>  $holderSubmission->id],
                [
                    'merge_report_name'             => $filePath,
                    'is_both_merge'                 => 1,
                ]
            );
            $response = [
                'pdf_url'    => asset('storage/'.$filePath),
                'status'    => true,
                'message'   => trans('cruds.prepare_report.fields.merge_report').' '.trans('messages.generate_success_message'),
            ];
        } catch (\Exception $e) {
            $response = [
                'pdf_url'    => "",
                'status'    => false,
                'message'   => $e->getMessage(),
            ];
        }        
        return response()->json($response);
    }

    public function updateSteps(UpdateStepsRequest $request, HolderSubmission $holderSubmission){
        $can_move_next_step = false;
        $lastStep = false;
        $successRes = false;
        $step = "";
        $currentStep = $request->current_step;
        $submissionCurrentStage = str_replace('stage_', '', $holderSubmission->current_stage);
        $returnMsg = null;
        $returnSuccessMsg = null;
        $toastrStatus = "success";
        /* Processing - Stage 1 - Bill and Verify Payments */
        if($request->current_step == 1){
            $successRes = true;
            $step = trans('cruds.bill_verify_payments.title_singular');
            $verifyPayment = VerifyPayment::updateOrCreate(
                ['holder_submission_id' =>  $holderSubmission->id],
                [
                    'holder_submission_id'  => $holderSubmission->id,
                    'bill_amount'           => $holderSubmission->id,
                    'paid_amount'           => ($request->payment_status == 'fully_paid') ? 0 : $request->paid_amount,
                    'payment_status'        => $request->payment_status,
                    'payment_ref'           => $request->payment_ref,
                    'is_stage1_completed'   => 1,
                ]
            );
            if($verifyPayment->is_stage1_completed == 1){
                $can_move_next_step = true;
                $this->submissionUpdate($holderSubmission, $request->current_step, $request->is_moved);
            }else{
                $returnSuccessMsg = "Payment status must be fully paid to move next stage!";
                $toastrStatus = "info";
            }
        }
        
        /* Processing - Stage 2 - Request Verification */
        if($request->current_step == 2){
            $successRes = true;
            $step = trans('cruds.request_verification.title_singular');
            $requestVerification = RequestVerification::updateOrCreate(
                ['holder_submission_id' =>  $holderSubmission->id],
                [
                    'holder_submission_id'              => $holderSubmission->id,
                    'o_level_certificate_source'        => $request->o_level_certificate_source,
                    'o_level_certificate_status'        => $request->o_level_certificate_status,
                    'degree_certificate_source'         => $request->degree_certificate_source,
                    'degree_certificate_status'         => $request->degree_certificate_status,
                    'academic_transcript_source'        => $request->academic_transcript_source,
                    'academic_transcript_status'        => $request->academic_transcript_status,
                ]
            );
            if($requestVerification->is_stage2_completed){
                $can_move_next_step = true;
                $this->submissionUpdate($holderSubmission, $request->current_step, $request->is_moved);
            }else{
                $returnSuccessMsg = "Verification outcome must be uploaded for all documents to move next stage";
                $toastrStatus = "info";
            }
        }

        /* Processing - Stage 3 - Extract Transcript */
        if($request->current_step == 3){
            $successRes = true;
            $step = trans('cruds.extract_transcript.title_singular'); 
            $extractTranscript = $this->saveExtractTranscriptData($holderSubmission, $request);                      
            if($extractTranscript){                
                if($extractTranscript->is_stage3_completed){
                    $can_move_next_step = true;
                    $this->submissionUpdate($holderSubmission, $request->current_step, $request->is_moved);
                }else{
                    $returnSuccessMsg = "Please fill mapping details first!";
                    $toastrStatus = "info";
                }
            }
        }

        /* Processing - Stage 4 - Update Verification */
        if($request->current_step == 4){
            $successRes = true;
            $step = trans('cruds.update_verification.title_singular');
            $updateVerification = UpdateVerification::updateOrCreate(
                ['holder_submission_id' =>  $holderSubmission->id],
                [
                    'holder_submission_id'                     => $holderSubmission->id,
                    'update_o_level_certificate_source'        => $request->update_o_level_certificate_source,
                    'update_o_level_certificate_status'        => $request->update_o_level_certificate_status,
                    'o_level_verification_status'              => $request->o_level_verification_status,
                    'update_degree_certificate_source'         => $request->update_degree_certificate_source,
                    'update_degree_certificate_status'         => $request->update_degree_certificate_status,
                    'degree_verification_status'               => $request->degree_verification_status,
                    'update_transcript_source'                 => $request->update_transcript_source,
                    'update_transcript_status'                 => $request->update_transcript_status,
                    'transcript_verification_status'           => $request->transcript_verification_status,
                ]
            );
            if($updateVerification->is_stage4_completed){
                $can_move_next_step = true;
                $this->submissionUpdate($holderSubmission, $request->current_step, $request->is_moved);
            }else{
                $returnSuccessMsg = "Overall verification status must be yes for all documents to move next stage";
                $toastrStatus = "info";
            }
        }

        /* Processing - Stage 5 - Perform Evaluation */
        if($request->current_step == 5){
            $successRes = true;
            $step = trans('cruds.perform_evaluation.title_singular');
            $requestVerification = PerformEvaluation::updateOrCreate(
                ['holder_submission_id' =>  $holderSubmission->id],
                [
                    'holder_submission_id'      => $holderSubmission->id,
                    'nigeria'                   => $request->nigeria,
                    'degree'                    => $request->degree,
                    'comparability'             => $request->comparability,
                    'undergraduate_admission'   => $request->undergraduate_admission,
                    'admission_notes_1'         => $request->admission_notes_1,
                    'admission_notes_2'         => $request->admission_notes_2,
                    'summary_notes_1'           => $request->summary_notes_1,
                    'summary_notes_2'           => $request->summary_notes_2,
                    'summary_notes_3'           => $request->summary_notes_3,
                    'is_stage5_completed'       => 1,
                ]
            );
            if($requestVerification->is_stage5_completed){
                $can_move_next_step = true;
                $this->submissionUpdate($holderSubmission, $request->current_step, $request->is_moved);
            }
        }

        /* Processing - Stage 6 - Prepare Report */
        if($request->current_step == 6){
            $step = trans('cruds.prepare_report.title_singular');

            if($holderSubmission->stage6 && !empty($holderSubmission->stage6)){
                if($holderSubmission->stage6->merge_report_name == "" && !$holderSubmission->stage6->is_both_merge){
                    $successRes = false;
                    $returnMsg = "Please generate required reports first!";
                }else{
                    $successRes = true;
                    $holderSubmission->stage6->update(['is_stage6_completed' => 1]);
                }
                if($holderSubmission->stage6->is_stage6_completed){
                    $can_move_next_step = true;
                    $this->submissionUpdate($holderSubmission, $request->current_step, $request->is_moved);
                }
            }else{
                $successRes = false;
                $returnMsg = "Please generate required reports first!";
            }
        }

        /* Processing - Stage 7 - Validate Report */
        if($request->current_step == 7){
            $step = trans('cruds.validate_report.title_singular');

            $successRes = true;
            $validateReport = ValidateReport::updateOrCreate(
                ['holder_submission_id' =>  $holderSubmission->id],
                [
                    'holder_submission_id'      => $holderSubmission->id,
                    'is_report_validate'        => 1,
                    'is_stage7_completed'       => 1,
                ]
            );
            if($validateReport->is_stage7_completed){
                $can_move_next_step = true;
                $this->submissionUpdate($holderSubmission, $request->current_step, $request->is_moved);
            }
        }

        /* Processing - Stage 8 - Deliver Report */
        if($request->current_step == 8){
            if($holderSubmission->is_all_document_submitted){                
                $step = trans('cruds.deliver_report.title_singular');
                $deliverReport = DeliverReport::updateOrCreate(
                    ['holder_submission_id' =>  $holderSubmission->id],
                    [
                        'holder_submission_id'      => $holderSubmission->id,
                    ]
                );
                if($deliverReport){
                    if(isset($request->recipent) && !empty($request->recipent)){
                        // $reportLink = asset('storage/'.$holderSubmission->stage6->merge_report_name);                    
                        $reportLink = public_path() . '/storage/' . $holderSubmission->stage6->merge_report_name;                    
                        foreach ($request->recipent as $key => $recipent) {
                            $recipentDeliverReport = $deliverReport->deliverReportReceivers()->updateOrCreate(
                                [
                                    'deliver_report_id' =>  $deliverReport->id,
                                    'id'                =>  $recipent['deliver_report_receiver_id'] ?? null,
                                ],
                                [
                                    'deliver_report_id'      => $deliverReport->id,
                                    'recipent_name'          => $recipent['name'],
                                    'recipent_email'         => $recipent['email'],
                                ]
                            );
                            $result = Mail::to($recipent['email'])->send(new SubmissionReportDeliver($holderSubmission,$recipentDeliverReport,$reportLink));
                            if($result){
                                $recipentDeliverReport->update(['is_delivered' => 1]);
                            }
                        }
                        $deliverReport->update(['is_report_delivered' => 1, 'is_stage8_completed' => 1]);
                    }
                    if($deliverReport->is_stage8_completed){
                        $lastStep = true;
                        $successRes = true;
                        $can_move_next_step = false;
                        $this->submissionUpdate($holderSubmission, $request->current_step, $request->is_moved, $lastStep);
                    }
                }
            }else{
                $returnMsg = trans('messages.documents_required_message');
                $toastrStatus = "info";
            }            
        }

        if($successRes){
            // Send mail when stage changed (Both Previous and Next Stages)
            if($can_move_next_step || $lastStep){
                $nextStageName  = config('constant.holderSubmissionStages.heading_titles.'.$holderSubmission->current_stage);
                $mailSend       = Mail::to(config('constant.submission_receiver_email_address'))->send(new SubmissionStageChangedMail($holderSubmission));
            }

            $message = $returnSuccessMsg ?? $step.' '.trans('messages.submit_success_message');
            if(isset($request->is_moved) && $request->is_moved == "true"){
                $message = "You have revert to ". $step.' successfully!';
            }
            $next_step = $can_move_next_step ? ($request->current_step+1)-1 : ($request->current_step)-1;
            if($lastStep){
                $next_step = 8;
            }
            $response = [
                'can_move_next_step'    => $can_move_next_step,
                'next_step'             => $next_step,
                'status'                => true,
                'message'               => $message,
                'toastr_status'         => $toastrStatus,
            ];
        }else{
            $response = [
                'can_move_next_step'    => $can_move_next_step,
                'next_step'             => ($request->current_step)-1,
                'status'                => false,
                'message'               => $returnMsg ?? "Invalid action",
                'toastr_status'         => ($toastrStatus =="info")? $toastrStatus : "danger",
            ];
        }
        return response()->json($response);
    }

    public function saveExtractTranscriptData($holderSubmission, $request){ // submission stage 3
        if($holderSubmission->stage3 && !empty($holderSubmission->stage3)){
            if($holderSubmission->stage3->evaluation_template_id != $request->evaluation_template_id){
                $holderSubmission->stage3->extractTranscriptMappings()->delete(); // delete mappings if template changed
            }
        }

        $extractTranscript = ExtractTranscript::updateOrCreate(
            ['holder_submission_id' =>  $holderSubmission->id],
            [
                'holder_submission_id'              => $holderSubmission->id,
                'evaluation_template_id'            => $request->evaluation_template_id,
                'is_stage3_completed'               => 1,
            ]
        );
        if($extractTranscript){
            if(isset($request->mappings) && !empty($request->mappings)){
                foreach ($request->mappings as $key => $value) {
                    $extractTranscriptMapping = ExtractTranscriptMapping::updateOrCreate(
                        [
                            'extract_transcript_id' => $extractTranscript->id,
                            // 'evaluation_template_mapping_id' => $value['evaluation_template_mapping_id'],
                            'issuer_curriculum_details_id' => $value['issuer_curriculum_details_id'],
                        ],
                        [
                            'extract_transcript_id'          => $extractTranscript->id,
                            'evaluation_template_mapping_id' => $value['evaluation_template_mapping_id'],
                            'issuer_curriculum_details_id'   => $value['issuer_curriculum_details_id'],
                            'earned'                         => $value['earned'],
                            'grade'                          => strtoupper($value['grade']),
                            'point'                          => $value['point'],
                        ]
                    );  
                }
            }
            return $extractTranscript;
        }
        return null;
    }

    public function getTemplateMappings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evaluation_template_id'     => [
                'required',
                'numeric',
                'exists:evaluation_templates,id',
            ],
        ]);
        if ($validator->fails()) {
            return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
        }
        $extractTranscript = null;
        if(isset($request->submission_id) && $request->submission_id && $request->submission_id != ""){
            $holderSubmission   = HolderSubmission::find($request->submission_id);
            $extractTranscript  = $holderSubmission->stage3;
        }        
        
        $mappings       = $this->getCurriculumDetailsQuery($request->evaluation_template_id,$extractTranscript,false,"getMappings")->groupBy('course_name')->get();
        
        $total_records  = $mappings->count();
        $html  = view('admin/processing_submissions/partials/_template_mappings',compact('mappings'))->render();
        
        return response()->json(['message' => 'Template Mappings!', 'status' => true, 'html' => $html, 'total_records' => $total_records]);            
    }    

    /**
     * For receiver curriculum details
     * [getReceiversCurriculumDetailsQuery description]
     * @param  [type] $evaluation_template_id [description]
     * @param  [type] $extractTranscript      [description]
     * @return [type]                         [description]
     */
    public function getReceiversCurriculumDetailsQuery($evaluation_template_id, $extractTranscript=null){
        $evaluationTemplate =  EvaluationTemplate::find($evaluation_template_id);    
        $mappings = null;
        if($evaluationTemplate){            
            $selectColumns = ['curriculum_details.*','level_masters.title as level','evaluation_template_mappings.id as evaluation_template_mapping_id'];
            $mappings   = $evaluationTemplate->receiverCurriculum->curriculumDetail()                            
                            ->leftJoin('level_masters','curriculum_details.level_master_id','=','level_masters.id')
                            ->leftJoin('evaluation_template_mappings', function ($join) use($extractTranscript){
                                $join->on('curriculum_details.id', '=', 'evaluation_template_mappings.receiver_curriculum_details_id')
                                ->where('evaluation_template_mappings.evaluation_template_id', $extractTranscript->evaluation_template_id);
                            });          

            $mappings   = $mappings->select($selectColumns)
                                ->orderBy('level_masters.title','asc')->orderBy('course_name','asc')
                                ->groupBy('course_name');
        }   
        return $mappings;
    }

    /**
     * For issuer curriculum details
     * [getCurriculumDetailsQuery description]
     * @param  [type]  $evaluation_template_id [description]
     * @param  [type]  $extractTranscript      [description]
     * @param  boolean $duplicate              [description]
     * @return [type]                          [description]
     */
    public function getCurriculumDetailsQuery($evaluation_template_id,$extractTranscript=null,$duplicate=false,$callType=""){
        $evaluationTemplate =  EvaluationTemplate::find($evaluation_template_id);    
        $mappings = null;
        if($evaluationTemplate){            
            $selectColumns = ['curriculum_details.*','curriculum_details.id as issuer_curriculum_details_id','level_masters.title as level','evaluation_template_mappings.id as evaluation_template_mapping_id','evaluation_template_mappings.receiver_curriculum_details_id'];
            $mappings   = $evaluationTemplate->issuerCurriculum->curriculumDetail()                            
                            ->leftJoin('level_masters','curriculum_details.level_master_id','=','level_masters.id')
                            ->leftJoin('evaluation_template_mappings','curriculum_details.id','=','evaluation_template_mappings.issuer_curriculum_details_id');
            if($extractTranscript){
                $selectColumns = array_merge($selectColumns,['extract_transcript_mappings.extract_transcript_id','extract_transcript_mappings.id as extract_transcript_mapping_id','extract_transcript_mappings.earned','extract_transcript_mappings.grade','extract_transcript_mappings.point']);

                if($callType && $callType == "getMappings"){
                    $mappings   = $mappings->leftJoin('extract_transcript_mappings', function ($join) use($extractTranscript){
                                    $join->on('curriculum_details.id', '=', 'extract_transcript_mappings.issuer_curriculum_details_id')
                                    ->where('extract_transcript_mappings.extract_transcript_id', $extractTranscript->id);
                    });
                }else{
                    $mappings   = $mappings->leftJoin('extract_transcript_mappings', function ($join) use($extractTranscript){
                                    $join->on('evaluation_template_mappings.id', '=', 'extract_transcript_mappings.evaluation_template_mapping_id')
                                    ->where('extract_transcript_mappings.extract_transcript_id', $extractTranscript->id);
                    });                    
                }
            }
            $mappings   = $mappings->select($selectColumns)
                                ->orderBy('level_masters.title','asc')->orderBy('course_name','asc');
            if(!$duplicate){
                // $mappings   = $mappings->groupBy('course_name');
            }
        }   
        return $mappings;
    }

    public function submissionUpdate($holderSubmission, $currentStep, $isMoved, $lastStep=false){
        $currentStage       = $currentStep+1;
        if($isMoved == "true"){
            $currentStage       = $currentStep;
        }
        $nextStage          = $currentStage+1;
        $data['pre_stage']      = 'stage_'.$currentStep;
        $data['current_stage']  = 'stage_'.$currentStage;
        $data['is_stage'.$currentStep.'_completed']  = 1;
        $data['next_stage'] = 'stage_'.$nextStage;

        if($lastStep){ 
            // $data['current_stage'] = 'stage_'.$currentStep; // need to clear with client
            $data['current_stage'] = "stage_9"; // need to clear with client
            $data['next_stage'] = ""; // completed
            $data['is_all_stage_completed'] = 1; 
            $data['is_all_document_submitted'] = 1; 
        }
        $holderSubmission = $holderSubmission->update($data);        
        return true;
    }

    public function deleteReportRecipent(Request $request, $recipent_id){
        $record = DeliverReportReceiver::find($recipent_id);
        if($record){
            $record->delete();
            return response()->json(['message' => 'Recipent Deleted successfully!', 'status' => true],200);    
        }
        return response()->json(['message' => 'Something went wrong...Please try again!', 'status' => false],200);
    }

}