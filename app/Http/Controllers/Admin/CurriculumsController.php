<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Curriculum\StoreRequest;
use App\Http\Requests\Curriculum\UpdateRequest;
use App\Models\Curriculum;
use App\Models\Issuer;
use App\Models\Receiver;
use App\Models\Degree;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Validator;

use App\DataTables\CurriculumsDataTable;

class CurriculumsController extends Controller
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

    public function index(CurriculumsDataTable $dataTable)
    {
        abort_if(Gate::denies('curriculums_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('cruds.'.$this->type.'.title_singular')." | ".trans('panel.page_title.curriculums.list');
        return $dataTable->render('admin.shared.curriculums.index', compact('pageTitle'));
    }

    public function create()
    {
        abort_if(Gate::denies('curriculums_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $types      = [];
        if($this->type == 'issuer'){
            $types  = Issuer::pluck('name','id');
        }else{
            $types  = Receiver::pluck('name','id');            
        }
        $degrees    = Degree::pluck('qualification','id');
        $status     = $this->status;
        $html       = view('admin.shared.curriculums.create',compact('types','degrees','status'))->render();
        return response()->json(['html' => $html]);
    }

    public function store(StoreRequest $request)
    {
        // $curriculum = Curriculum::create($request->all());  
        $curriculumable = null;
        if($this->type == 'issuer'){
            $curriculumable = Issuer::find($request->curriculumable_id);
        }else{
            $curriculumable = Receiver::find($request->curriculumable_id);
        }
        if($curriculumable){
            $curriculumable->curriculums()->create($request->all());            
            return response()->json(['success' => true, 'message' => trans('cruds.curriculums.title_singular').' '.trans('messages.add_success_message')], 200);    
        }else{
            return response()->json(['success' => false, 'message' => trans('messages.error_message')], 400);
        }
    }

    public function edit($type, Curriculum $curriculum)
    {
        abort_if(Gate::denies('curriculums_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $types      = [];
        if($this->type == 'issuer'){
            $types  = Issuer::pluck('name','id');
        }else{
            $types  = Receiver::pluck('name','id');            
        }
        $status     = $this->status;
        $html       = view('admin.shared.curriculums.edit', compact('curriculum','types','status'))->render();
        return response()->json(['html' => $html]);
    }

    public function update(UpdateRequest $request, $type, Curriculum $curriculum)
    {
        $curriculum->update($request->except(['_token','_method']));
        // $curriculum->update($request->all());
        return response()->json(['success' => true, 'message' => trans('cruds.curriculums.title_singular').' '.trans('messages.edit_success_message')], 200);
    }

    public function show($type, Curriculum $curriculum)
    {
        abort_if(Gate::denies('curriculums_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $html  = view('admin.shared.curriculums.show', compact('curriculum'))->render();
        return response()->json(['html' => $html]);
        // return view('admin.shared.curriculums.show', compact('curriculum'));
    }

    public function destroy($type, Curriculum $curriculum)
    {
        abort_if(Gate::denies('curriculums_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $curriculum->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.curriculums.title_singular').' '.trans('messages.delete_success_message')], 200);
    }

    public function changeStatus($type, Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:curriculums,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $curriculum = Curriculum::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.curriculums.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }

    public function getAllOptions(Request $request, $type)
    {
        if($type == 'issuer'){
            $modelName = '\Issuer';
            $tableName = 'degrees';
        }else{
            $tableName = 'degrees';            
            $modelName = '\Receiver';
        }
        $validator = Validator::make($request->all(), [
            'degree_id'     => [
                'required',
                'numeric',
                'exists:'.$tableName.',id',
            ],
        ]);
        if (!$validator->passes()) {
            return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
        }else{
            $curriculumDegreeId = $request->degree_id;
            $curriculums = Curriculum::whereHasMorph('curriculumable','App\Models'.$modelName, function($query) use($curriculumDegreeId){
                $query->where('degree_id',$curriculumDegreeId);
            })->get()->pluck('name', 'id');

            $options            = '<option value=""> Select Curriculum </option>';
            if($curriculums->count() > 0){
                foreach ($curriculums as $key => $value) {
                    $selected     = '';
                    if($key == $request->curriculum_id){
                        $selected = 'selected';
                    }
                    $options     .= '<option value="'.$key.'"'.$selected.'> '.$value.'</option>';
                }
            }
            return response()->json(['message' => 'Curriculum!','options' => $options, 'status' => true]);            
        }
    }

}
