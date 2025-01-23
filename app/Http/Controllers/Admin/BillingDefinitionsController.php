<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Gate;
use Validator;
use App\Models\BillingDefinition;
use App\Models\Issuer;
use App\Models\Receiver;
use App\Http\Requests\BillingDefinition\UpdateRequest;
use App\Http\Requests\BillingDefinition\StoreRequest;
use App\DataTables\BillingDefinitionsDataTable;

class BillingDefinitionsController extends Controller
{
    private $status;
    private $billingType;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status               = config('constant.enums.status');
        $this->billingType          = request()->billingType;
        if(!in_array($this->billingType, ['issuer','receiver'])){
            return abort('403');
        }
    }

    public function index(BillingDefinitionsDataTable $dataTable)
    {
        abort_if(Gate::denies('billing_definitions_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('cruds.'.$this->billingType.'.title_singular')." | ".trans('panel.page_title.billing_definitions.list');
        return $dataTable->render('admin.shared.billing_definitions.index', compact('pageTitle'));
    }

    public function create(){
        abort_if(Gate::denies('billing_definitions_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle           = trans('cruds.'.$this->billingType.'.title_singular')." | ".trans('panel.page_title.billing_definitions.add');
        $status              = $this->status;
        $billingTypes = [];
        if($this->billingType == 'issuer'){
            $billingTypes = Issuer::pluck('name','id');
        }else{
            $billingTypes = Receiver::pluck('name','id');            
        }
        return view('admin.shared.billing_definitions.create', compact('pageTitle','status', 'billingTypes'));
    }

    public function store(StoreRequest $request)
    {
        $billableType = null;
        if($this->billingType == 'issuer'){
            $billableType = Issuer::find($request->billable_id);
        }else{
            $billableType = Receiver::find($request->billable_id);            
        }
        if($billableType){
            $inputs = $request->all();
            $totalFees = $request->evaluation_fees + $request->translation_fees + $request->verification_fees + $request->other_fees;
            $inputs['evaluation_fees'] = $totalFees;
            $billableType->billingDefinitions()->create($inputs);
            $notification = ['message' => trans('cruds.billing_definitions.title_singular')." ".trans('messages.add_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        }else{
            $notification = ['message' => trans('messages.error_message'),'alert-type' =>  trans('panel.alert-type.error')];
        }
        return redirect()->route('admin.billing-definitions.index',$this->billingType)->with($notification);
    }

    public function edit(Request $request, $billingType, BillingDefinition $billingDefinition)
    {
        abort_if(Gate::denies('billing_definitions_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('cruds.'.$this->billingType.'.title_singular')." | ".trans('panel.page_title.issuer_degrees.edit');
        $status              = $this->status;
        $billingTypes = [];
        if($this->billingType == 'issuer'){
            $billingTypes = Issuer::pluck('name','id');
        }else{
            $billingTypes = Receiver::pluck('name','id');            
        }
        return view('admin.shared.billing_definitions.edit', compact('billingDefinition','pageTitle', 'billingTypes','status'));
    }

    public function update(UpdateRequest $request, $billingType, BillingDefinition $billingDefinition)
    {
        $billingDefinition->update($request->except(['_token','_method']));
        $notification = ['message' => trans('cruds.billing_definitions.title_singular')." ".trans('messages.edit_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.billing-definitions.index',$this->billingType)->with($notification);
    }

    public function show($billingType, BillingDefinition $billingDefinition)
    {
        abort_if(Gate::denies('billing_definitions_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('cruds.'.$this->billingType.'.title_singular')." | ".trans('panel.page_title.billing_definitions.show');
        return view('admin.shared.billing_definitions.show', compact('billingDefinition','pageTitle'));
    }

    public function destroy($billingType, BillingDefinition $billingDefinition)
    {
        abort_if(Gate::denies('billing_definitions_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $billingDefinition->delete();
        return response()->json(['message'=>trans('cruds.billing_definitions.title_singular')." ".trans('messages.delete_success_message')],200);
    }

    public function getFeesToPay(Request $request)
    {
        if ($request->issuerDegreeId && $request->receiverDegreeId) {
            $issuerDegreeId = $request->issuerDegreeId;   
            $receiverDegreeId = $request->receiverDegreeId;
            $totalFees = BillingDefinition::whereHas('degree', function($query) use($issuerDegreeId, $receiverDegreeId){
                $query->where('degree_id', $issuerDegreeId);
                $query->orWhere('degree_id', $receiverDegreeId);
            })->sum('total_fees');
        }
        
        return response()->json(['success' => true, 'totalFees' => $totalFees], 200);
    }

    public function changeStatus($billingType, Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:billing_definitions,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $billingDefinition = BillingDefinition::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.billing_definitions.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }
}
