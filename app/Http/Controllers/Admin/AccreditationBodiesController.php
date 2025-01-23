<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccreditationBody\StoreRequest;
use App\Http\Requests\AccreditationBody\UpdateRequest;
use App\Models\AccreditationBody;
use App\Models\Country;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Validator;

use App\DataTables\AccreditationBodiesDataTable;

class AccreditationBodiesController extends Controller
{

    public function index(AccreditationBodiesDataTable $dataTable)
    {
        abort_if(Gate::denies('accreditation_body_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.master.accreditation_body.list');
        return $dataTable->render('admin.master.accreditation-bodies.index', compact('pageTitle'));
    }

    public function create()
    {
        abort_if(Gate::denies('accreditation_body_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::pluck('name','id');
        $html = view('admin.master.accreditation-bodies.create',compact('countries'))->render();
        return response()->json(['html' => $html]);
    }

    public function store(StoreRequest $request)
    {
        $accreditationBody = AccreditationBody::create($request->all());  
        return response()->json(['success' => true, 'message' => trans('cruds.accreditation_bodies.title_singular').' '.trans('messages.add_success_message')], 200);    
    }

    public function edit(AccreditationBody $accreditationBody)
    {
        abort_if(Gate::denies('accreditation_body_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $countries = Country::pluck('name','id');
        $html = view('admin.master.accreditation-bodies.edit', compact('accreditationBody','countries'))->render();
        return response()->json(['html' => $html]);
    }

    public function update(UpdateRequest $request, AccreditationBody $accreditationBody)
    {
        $accreditationBody->update($request->all());
        return response()->json(['success' => true, 'message' => trans('cruds.accreditation_bodies.title_singular').' '.trans('messages.edit_success_message')], 200);
    }

    public function show(AccreditationBody $accreditationBody)
    {
        abort_if(Gate::denies('accreditation_body_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.master.accreditation_body.show');
        return view('admin.master.accreditation-bodies.show', compact('accreditationBody','pageTitle'));
    }

    public function destroy(AccreditationBody $accreditationBody)
    {
        abort_if(Gate::denies('accreditation_body_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $accreditationBody->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.accreditation_bodies.title_singular').' '.trans('messages.delete_success_message')], 200);
    }

    public function changeStatus(Request $request){
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id'     => [
                    'required',
                    'numeric',
                    'exists:accreditation_bodies,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $country = AccreditationBody::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.accreditation_bodies.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }


    public function getAllOptions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_id'     => 'required|numeric|exists:countries,id'
        ]);
        
        if ($validator->fails()) {
            return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
        }
        $accreditationBodies = AccreditationBody::where('country_id', $request->country_id)->pluck('name', 'id');

        $options            = '<option value=""> Select Accreditation Body </option>';
        if($accreditationBodies->count() > 0){
            foreach ($accreditationBodies as $key => $value) {
                $selected     = '';
                if($key == $request->accreditation_body_id){
                    $selected = 'selected';
                }
                $options     .= '<option value="'.$key.'"'.$selected.'> '.$value.'</option>';
            }
        }
        return response()->json(['message' => 'Accreditation Body!','options' => $options, 'status' => true]);            
    }
}
