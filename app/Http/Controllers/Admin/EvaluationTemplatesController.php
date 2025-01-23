<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationTemplates\StoreRequest;
use App\Http\Requests\EvaluationTemplates\UpdateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\DataTables\EvaluationTemplatesDataTable;
use App\Models\EvaluationTemplate;
use App\Models\Issuer;
use App\Models\Receiver;
use App\Models\Curriculum;

use Auth;
use Gate;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Validator;

class EvaluationTemplatesController extends Controller
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


    public function index(EvaluationTemplatesDataTable $dataTable)
    {
        abort_if(Gate::denies('evaluation_templates_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.evaluation_templates.list');
        return $dataTable->render('admin.evaluation_templates.index', compact('pageTitle'));
    }

    public function create(){
        abort_if(Gate::denies('evaluation_templates_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle           = trans('panel.page_title.evaluation_templates.add');
        $status              = $this->status;
        
        $issuerTypes  = Issuer::pluck('name','id');
        $receiverTypes  = Receiver::pluck('name','id');
        
        $issuers = Curriculum::where('curriculumable_type', '=', 'App\Models\Issuer')->pluck('name', 'id');

        $receivers = Curriculum::where('curriculumable_type', '=', 'App\Models\Receiver')->pluck('name', 'id');
        
        return view('admin.evaluation_templates.create', compact('pageTitle','status','issuers','receivers','issuerTypes','receiverTypes'));
    }

    public function store(StoreRequest $request)
    {
        $evaluationTemplate = EvaluationTemplate::create($request->all());
        $notification = ['message' => trans('cruds.evaluation_templates.title_singular')." ".trans('messages.add_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.evaluation-templates.index')->with($notification);
    }

    public function edit(EvaluationTemplate $evaluationTemplate)
    {
        abort_if(Gate::denies('evaluation_templates_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.evaluation_templates.edit');
        $status              = $this->status;

        $issuerTypes  = Issuer::pluck('name','id');
        $receiverTypes  = Receiver::pluck('name','id');
        
        return view('admin.evaluation_templates.edit', compact('evaluationTemplate','pageTitle','status','issuerTypes','receiverTypes'));
    }

    public function update(UpdateRequest $request, EvaluationTemplate $evaluationTemplate)
    {
        $evaluationTemplate->update($request->all());
        $notification = ['message' => trans('cruds.evaluation_templates.title_singular')." ".trans('messages.edit_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.evaluation-templates.index')->with($notification);
    }

    public function show(EvaluationTemplate $evaluationTemplate)
    {
        abort_if(Gate::denies('evaluation_templates_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.evaluation_templatess.show');
        $status              = $this->status;
        return view('admin.evaluation_templates.show', compact('evaluationTemplate','pageTitle','status'));
    }

    public function destroy(EvaluationTemplate $evaluationTemplate)
    {
        abort_if(Gate::denies('evaluation_templates_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $evaluationTemplate->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.evaluation_templates.title_singular').' '.trans('messages.delete_success_message')], 200);        
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:evaluation_templates,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $evaluationTemplate = EvaluationTemplate::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.evaluation_templates.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }

    public function getAllRecords(Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'evaluation_template_id' => [
                    'required',
                    'numeric',
                    'exists:evaluation_templates,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                $id = $request->evaluation_template_id;
                $records = EvaluationTemplate::find($id);
                $issuerId = $records->issuers->name;
                $issuerDegreeId = $records->issuerDegree->qualification;
                $issuerCurriculumId = $records->issuerCurriculum->name;
                $receiverId = $records->receivers->name;
                $receiverDegreeId = $records->receiverDegree->qualification;
                $receiverCurriculumId = $records->receiverCurriculum->name;
                $response = [
                    'status'    => 'true',
                    'issuer_id' => $issuerId,
                    'issuer_degree_id' => $issuerDegreeId,
                    'issuer_curriculum_id' => $issuerCurriculumId,
                    'receiver_id' => $receiverId,
                    'receiver_degree_id' => $receiverDegreeId,
                    'receiver_curriculum_id' => $receiverCurriculumId,
                ];
                return response()->json($response);
            }
        }
    }
}