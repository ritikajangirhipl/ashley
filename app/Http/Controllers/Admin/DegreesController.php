<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Gate;
use Validator;
use App\Models\AccreditationBody;
use App\Models\Degree;
use App\Models\Country;
use App\Models\Issuer;
use App\Models\Receiver;
use App\Http\Requests\Degree\UpdateRequest;
use App\Http\Requests\Degree\StoreRequest;
use App\DataTables\DegreesDataTable;

class DegreesController extends Controller
{
    private $status;
    private $accreditationStatus;
    private $courseType;
    private $type;
    private $degreeType;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status               = config('constant.enums.status');
        $this->courseType           = config('constant.enums.courseType');
        $this->accreditationStatus  = config('constant.enums.accreditationStatus');
        $this->type                 = config('constant.enums.type');
        $this->degreeType           = request()->degreeType;
        if(!in_array($this->degreeType, ['issuer','receiver'])){
            return abort('403');
        }
    }

    public function index(DegreesDataTable $dataTable)
    {
        abort_if(Gate::denies('degrees_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('cruds.'.$this->degreeType.'.title_singular')." | ".trans('panel.page_title.degrees.list');
        return $dataTable->render('admin.shared.degrees.index', compact('pageTitle'));
    }

    public function create(){
        abort_if(Gate::denies('degrees_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle           = trans('cruds.'.$this->degreeType.'.title_singular')." | ".trans('panel.page_title.degrees.add');
        $countries           = Country::pluck('name','id');
        $accreditationBodies = AccreditationBody::pluck('name','id');
        $status              = $this->status;
        $courseType = $this->courseType;
        $accreditationStatus = $this->accreditationStatus;
        $degreeTypes = [];
        if($this->degreeType == 'issuer'){
            $degreeTypes = Issuer::pluck('name','id');
        }else{
            $degreeTypes = Receiver::pluck('name','id');            
        }
        return view('admin.shared.degrees.create', compact('pageTitle','countries','status','accreditationStatus','courseType','accreditationBodies', 'degreeTypes'));
    }

    public function store(StoreRequest $request)
    {
        $degrableType = null;
        if($this->degreeType == 'issuer'){
            $degrableType = Issuer::find($request->degrable_id);
        }else{
            $degrableType = Receiver::find($request->degrable_id);            
        }
        if($degrableType){
            $degrableType->degrees()->create($request->all());
            $notification = ['message' => trans('cruds.degrees.title_singular')." | ".trans('messages.add_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        }else{
            $notification = ['message' => trans('messages.error_message'),'alert-type' =>  trans('panel.alert-type.error')];
        }
        return redirect()->route('admin.degrees.index',$this->degreeType)->with($notification);
    }

    public function edit(Request $request, $degreeType, Degree $degree)
    {
        abort_if(Gate::denies('degrees_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('cruds.'.$this->degreeType.'.title_singular')." | ".trans('panel.page_title.issuer_degrees.edit');
        $countries           = Country::pluck('name','id');
        $accreditationBodies = AccreditationBody::pluck('name','id');
        $issuers             = Issuer::pluck('name','id');
        $status              = $this->status;
        $accreditationStatus = $this->accreditationStatus;
        $courseType = $this->courseType;
        $degreeTypes = [];
        if($this->degreeType == 'issuer'){
            $degreeTypes = Issuer::pluck('name','id');
        }else{
            $degreeTypes = Receiver::pluck('name','id');            
        }
        return view('admin.shared.degrees.edit', compact('degree','pageTitle','countries','accreditationBodies', 'degreeTypes','status','accreditationStatus','courseType'));
    }

    public function update(UpdateRequest $request, $degreeType, Degree $degree)
    {
        $degree->update($request->except(['_token','_method']));
        $notification = ['message' => trans('cruds.degrees.title_singular')." | ".trans('messages.edit_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.degrees.index',$this->degreeType)->with($notification);
    }

    public function show($degreeType, Degree $degree)
    {
        abort_if(Gate::denies('degrees_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('cruds.'.$this->degreeType.'.title_singular')." | ".trans('panel.page_title.degrees.show');
        $courseType = $this->courseType;
        return view('admin.shared.degrees.show', compact('degree','pageTitle','courseType'));
    }

    public function destroy($degreeType, Degree $degree)
    {
        abort_if(Gate::denies('degrees_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $degree->delete();
        return response()->json(['message'=>trans('cruds.degrees.title_singular')." ".trans('messages.delete_success_message')],200);
    }

    public function getAllOptions(Request $request, $degreeType)
    {
        if($degreeType == 'issuer'){
            $modelName = '\Issuer';
            $tableName = 'issuers';
        }else{
            $tableName = 'receivers';            
            $modelName = '\Receiver';
        }
        $validator = Validator::make($request->all(), [
            'degrable_id'     => [
                'required',
                'numeric',
                'exists:'.$tableName.',id',
            ],
        ]);
        if (!$validator->passes()) {
            return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
        }else{
            $degrableId = $request->degrable_id;
            $degrees = Degree::whereHasMorph('degrable','App\Models'.$modelName, function($query) use($degrableId){
                $query->where('degrable_id',$degrableId);
            })->get()->pluck('qualification', 'id');
            $options            = '<option value=""> Select Degree </option>';
            if($degrees->count() > 0){
                foreach ($degrees as $key => $value) {
                    $selected     = '';
                    if($key == $request->degree_id){
                        $selected = 'selected';
                    }
                    $options     .= '<option value="'.$key.'"'.$selected.'> '.$value.'</option>';
                }
            }
            return response()->json(['message' => 'Degrees!','options' => $options, 'status' => true]);            
        }
    }

    public function changeStatus($degreeType, Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:degrees,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $degree = Degree::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.degrees.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }

}
