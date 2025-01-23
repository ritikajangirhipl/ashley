<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationTemplateMapping\StoreRequest;
use App\Http\Requests\EvaluationTemplateMapping\UpdateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\DataTables\EvaluationTemplateMappingsDataTable;
use App\Models\EvaluationTemplateMapping;
use App\Models\EvaluationTemplate;
use App\Models\CurriculumDetail;
use App\Models\Curriculum;

use Auth;
use Gate;
use Validator;
class EvaluationTemplateMappingsController extends Controller
{
    private $status;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }


    public function index(EvaluationTemplateMappingsDataTable $dataTable)
    {
        abort_if(Gate::denies('evaluation_template_mapping_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.evaluation_template_mappings.list');
        return $dataTable->render('admin.evaluation_template_mapping.index', compact('pageTitle'));
    }

    public function create(){
        abort_if(Gate::denies('evaluation_template_mapping_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle           = trans('panel.page_title.evaluation_template_mappings.add');
        $status              = $this->status;
        $evaluationTemplate  = EvaluationTemplate::pluck('name', 'id');

        $issuers = CurriculumDetail::whereHas('curriculum', function($q){
            $q->where('curriculumable_type', '=', 'App\Models\Issuer');
        })->pluck('school_ref', 'id');

        $receivers = CurriculumDetail::whereHas('curriculum', function($q){
            $q->where('curriculumable_type', '=', 'App\Models\Receiver');
        })->pluck('school_ref', 'id');
                
        return view('admin.evaluation_template_mapping.create', compact('pageTitle','status','evaluationTemplate','issuers','receivers'));
    }

    public function store(StoreRequest $request)
    {
        $evaluationTemplateMapping = EvaluationTemplateMapping::create($request->all());
        $notification = ['message' => trans('cruds.evaluation_template_mapping.title_singular')." ".trans('messages.add_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.evaluation-template-mappings.index')->with($notification);
    }

    public function edit(EvaluationTemplateMapping $evaluationTemplateMapping)
    {
        abort_if(Gate::denies('evaluation_template_mapping_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.evaluation_template_mappings.edit');
        $status              = $this->status;
        $evaluationTemplate  = EvaluationTemplate::pluck('name', 'id');

        $issuers = CurriculumDetail::whereHas('curriculum', function($q){
            $q->where('curriculumable_type', '=', 'App\Models\Issuer');
        })->pluck('school_ref', 'curriculum_id');

        $receivers = CurriculumDetail::whereHas('curriculum', function($q){
            $q->where('curriculumable_type', '=', 'App\Models\Receiver');
        })->pluck('school_ref', 'curriculum_id');
        
        return view('admin.evaluation_template_mapping.edit', compact('evaluationTemplateMapping','pageTitle','status','evaluationTemplate','issuers','receivers'));
    }

    public function update(UpdateRequest $request, EvaluationTemplateMapping $evaluationTemplateMapping)
    {
        $evaluationTemplateMapping->update($request->all());
        $notification = ['message' => trans('cruds.evaluation_template_mapping.title_singular')." ".trans('messages.edit_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.evaluation-template-mappings.index')->with($notification);
    }

    public function show(EvaluationTemplateMapping $evaluationTemplateMapping)
    {
        abort_if(Gate::denies('evaluation_template_mapping_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.evaluation_template_mappings.show');
        $status              = $this->status;
        return view('admin.evaluation_template_mapping.show', compact('evaluationTemplateMapping','pageTitle','status'));
    }

    public function destroy(EvaluationTemplateMapping $evaluationTemplateMapping)
    {
        abort_if(Gate::denies('evaluation_template_mapping_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $evaluationTemplateMapping->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.evaluation_template_mapping.title_singular').' '.trans('messages.delete_success_message')], 200);        
    }

    public function changeStatus(Request $request){
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:evaluation_template_mappings,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $evaluationTemplateMapping = EvaluationTemplateMapping::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.evaluation_template_mapping.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }

    /**
    * getIssuerCurriculumDetailOptions value
    *
    */
    public function getIssuerCurriculumDetailOptions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evaluation_template_id'     => [
                'required',
                'numeric',
                'exists:evaluation_templates,id',
            ],
        ]);
        if (!$validator->passes()) {
            return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
        }else{
            $curriculumId = EvaluationTemplate::find($request->evaluation_template_id)->issuer_curriculum_id;
            $issuers = CurriculumDetail::whereHas('curriculum', function($query) use ($curriculumId){
                $query->where('curriculumable_type', '=', 'App\Models\Issuer');
                $query->where('curriculum_id',$curriculumId);
            })->get()->pluck('school_ref','id');


            /*$issuers = CurriculumDetail::whereHas('curriculum', function($query){
                $query->where('curriculumable_type', '=', 'App\Models\Issuer');
            })->get()->pluck('school_ref','id');*/

            $options = '<option value="">Select'.' '.trans('cruds.evaluation_template_mapping.fields.issuer_curriculum_details_id').'</option>';
            if($issuers->count() > 0){
                foreach ($issuers as $key => $value) {
                    $selected     = '';
                    if($key == $request->issuer_curriculum_details_id){
                        $selected = 'selected';
                    }
                    $options     .= '<option value="'.$key.'"'.$selected.'> '.$value.'</option>';
                }
            }
            return response()->json(['message' => 'Issuer Curriculum Details!','options' => $options, 'status' => true]);            
        }
    }

    /**
    * getReceiverCurriculumDetailOptions value
    *
    */
    public function getReceiverCurriculumDetailOptions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evaluation_template_id'     => [
                'required',
                'numeric',
                'exists:evaluation_templates,id',
            ],
        ]);
        if (!$validator->passes()) {
            return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
        }else{
            $curriculumId = EvaluationTemplate::find($request->evaluation_template_id)->receiver_curriculum_id;
            $receivers = CurriculumDetail::whereHas('curriculum', function($query) use ($curriculumId){
                $query->where('curriculumable_type', 'App\Models\Receiver');
                $query->where('curriculum_id',$curriculumId);
            })->get()->pluck('school_ref','id');

            $options = '<option value="">Select'.' '.trans('cruds.evaluation_template_mapping.fields.receiver_curriculum_details_id').'</option>';
            if($receivers->count() > 0){
                foreach ($receivers as $key => $value) {
                    $selected     = '';
                    if($key == $request->receiver_curriculum_details_id){
                        $selected = 'selected';
                    }
                    $options     .= '<option value="'.$key.'"'.$selected.'> '.$value.'</option>';
                }
            }
            return response()->json(['message' => 'Receiver Curriculum Details!','options' => $options, 'status' => true]);            
        }
    }

   
}