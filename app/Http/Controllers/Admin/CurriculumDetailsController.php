<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurriculumDetail\StoreRequest;
use App\Http\Requests\CurriculumDetail\UpdateRequest;
use App\Models\Issuer;
use App\Models\Receiver;
use App\Models\Curriculum;
use App\Models\CurriculumDetail;
use App\Models\LevelMaster;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Validator;

use App\DataTables\CurriculumDetailsDataTable;

class CurriculumDetailsController extends Controller
{

    private $status;
    private $type;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status               = config('constant.enums.status');
        $this->type                 = request()->type;
        if(!in_array($this->type, ['issuer','receiver'])){
            return response()->json(['success' => false, 'message' => "Resource can't accessible!"], 400);
        }
    }

    public function index(CurriculumDetailsDataTable $dataTable)
    {
        abort_if(Gate::denies('curriculum_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('cruds.'.$this->type.'.title_singular')." | ".trans('panel.page_title.curriculum_details.list');
        return $dataTable->render('admin.shared.curriculum_details.index', compact('pageTitle'));
    }

    public function create()
    {
        abort_if(Gate::denies('curriculum_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $types      = [];
        if($this->type == 'issuer'){
            $types  = Issuer::pluck('name','id');
        }else{
            $types  = Receiver::pluck('name','id');            
        }
        $levelMaster = LevelMaster::pluck('title','id');
        $status      = $this->status;
        $html        = view('admin.shared.curriculum_details.create',compact('types','levelMaster','status'))->render();
        return response()->json(['html' => $html]);
    }

    public function store(StoreRequest $request)
    {
        if($request){
            $curriculumDetail = CurriculumDetail::create($request->all());            
            return response()->json(['success' => true, 'message' => trans('cruds.curriculum_details.title_singular').' '.trans('messages.add_success_message')], 200);    
        }else{
            return response()->json(['success' => false, 'message' => trans('messages.error_message')], 400);
        }
    }

    public function edit($type, CurriculumDetail $curriculumDetail)
    {
        abort_if(Gate::denies('curriculum_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $types      = [];
        if($this->type == 'issuer'){
            $types  = Issuer::pluck('name','id');
            $curriculum = Curriculum::where('id', $curriculumDetail->curriculum_id)->first();
        }else{
            $types  = Receiver::pluck('name','id');
            $curriculum = Curriculum::where('id', $curriculumDetail->curriculum_id)->first();           
        }

        $levelMaster = LevelMaster::pluck('title','id');
        $status     = $this->status;
        $html       = view('admin.shared.curriculum_details.edit', compact('curriculumDetail','types','curriculum','status','levelMaster'))->render();
        return response()->json(['html' => $html]);
    }

    public function update(UpdateRequest $request, $type, CurriculumDetail $curriculumDetail)
    {
        $curriculumDetail->update($request->except(['_token','_method']));
        return response()->json(['success' => true, 'message' => trans('cruds.curriculum_details.title_singular').' '.trans('messages.edit_success_message')], 200);
    }

    public function show($type, CurriculumDetail $curriculumDetail)
    {
        abort_if(Gate::denies('curriculum_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $html  = view('admin.shared.curriculum_details.show', compact('curriculumDetail', 'type'))->render();
        return response()->json(['html' => $html]);
    }

    public function destroy($type, CurriculumDetail $curriculumDetail)
    {
        abort_if(Gate::denies('curriculum_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $curriculumDetail->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.curriculum_details.title_singular').' '.trans('messages.delete_success_message')], 200);
    }


    public function changeCurriculumDetailsStatus(Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:curriculum_details,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $curriculumDetail = CurriculumDetail::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.curriculum_details.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }


}
