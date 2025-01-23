<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Issuer\StoreRequest;
use App\Http\Requests\Issuer\UpdateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\DataTables\IssuersDataTable;
use App\Models\Issuer;
use App\Models\Country;
use App\Models\AccreditationBody;

use Auth;
use Gate;
use Validator;

class IssuersController extends Controller
{
    private $status;
    private $issuerType;
    private $recognitionStatus;
    private $accreditationStatus;
    private $courseType;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status               = config('constant.enums.status');
        $this->issuerType           = config('constant.enums.issuerType');
        $this->courseType           = config('constant.enums.courseType');
        $this->recognitionStatus    = config('constant.enums.recognitionStatus');
        $this->accreditationStatus  = config('constant.enums.accreditationStatus');
    }


    public function index(IssuersDataTable $dataTable)
    {
        abort_if(Gate::denies('issuer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.issuer.list');
        return $dataTable->render('admin.issuers.index', compact('pageTitle'));
    }

    public function create(){
        abort_if(Gate::denies('issuer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle           = trans('panel.page_title.issuer.add');
        $countries           = Country::pluck('name','id');
        $accreditationBodies = AccreditationBody::pluck('name','id');

        $status              = $this->status;
        $issuerType          = $this->issuerType;
        $recognitionStatus   = $this->recognitionStatus;
        $accreditationStatus = $this->accreditationStatus;
        return view('admin.issuers.create', compact('pageTitle','countries','status','issuerType','recognitionStatus','accreditationStatus','accreditationBodies'));
    }

    public function store(StoreRequest $request)
    {
        $issuer = Issuer::create($request->all());
        $notification = ['message' => trans('cruds.issuer.title_singular')." ".trans('messages.add_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.issuers.index')->with($notification);
    }

    public function edit(Issuer $issuer)
    {
        abort_if(Gate::denies('issuer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.issuer.edit');
        $countries           = Country::pluck('name','id');
        $accreditationBodies = AccreditationBody::pluck('name','id');

        $status              = $this->status;
        $issuerType          = $this->issuerType;
        $recognitionStatus   = $this->recognitionStatus;
        $accreditationStatus = $this->accreditationStatus;
        return view('admin.issuers.edit', compact('issuer','pageTitle','countries','status','issuerType','recognitionStatus','accreditationStatus','accreditationBodies'));
    }

    public function update(UpdateRequest $request, Issuer $issuer)
    {
        $issuer->update($request->all());
        $notification = ['message' => trans('cruds.issuer.title_singular')." ".trans('messages.edit_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.issuers.index')->with($notification);
    }

    public function show(Issuer $issuer)
    {
        abort_if(Gate::denies('issuer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.issuer.show');

        $status              = $this->status;
        $issuerType          = $this->issuerType;
        $recognitionStatus   = $this->recognitionStatus;
        $accreditationStatus = $this->accreditationStatus;
        return view('admin.issuers.show', compact('issuer','pageTitle','status','issuerType','recognitionStatus','accreditationStatus'));
    }

    public function destroy(Issuer $issuer)
    {
        abort_if(Gate::denies('issuer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $issuer->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.issuer.title_singular').' '.trans('messages.delete_success_message')], 200);        
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:issuers,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $issuer = Issuer::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.issuer.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }
}