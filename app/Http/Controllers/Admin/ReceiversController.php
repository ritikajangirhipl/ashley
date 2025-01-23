<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Receiver\StoreRequest;
use App\Http\Requests\Receiver\UpdateRequest;
use App\DataTables\ReceiversDataTable;
use App\Models\Receiver;
use App\Models\Country;

use Auth;
use Gate;
use Validator;

class ReceiversController extends Controller
{
    private $status;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status               = config('constant.enums.status');
    }

    public function index(ReceiversDataTable $dataTable)
    {
        abort_if(Gate::denies('receivers_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.receiver.list');
        return $dataTable->render('admin.receivers.index', compact('pageTitle'));
    }

    public function create(){
        abort_if(Gate::denies('receivers_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle           = trans('panel.page_title.receiver.add');
        $countries           = Country::pluck('name','id');
        $status              = $this->status;
        return view('admin.receivers.create', compact('pageTitle','countries','status'));
    }

    public function store(StoreRequest $request)
    {
        $receiver = Receiver::create($request->all());
        $notification = ['message' => trans('cruds.receiver.title_singular')." ".trans('messages.add_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.receivers.index')->with($notification);
    }

    public function edit(Receiver $receiver)
    {
        abort_if(Gate::denies('receivers_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.receiver.edit');
        $countries           = Country::pluck('name','id');
        $status              = $this->status;
        return view('admin.receivers.edit', compact('receiver','pageTitle','countries','status'));
    }

    public function update(UpdateRequest $request, Receiver $receiver)
    {
        $receiver->update($request->all());
        $notification = ['message' => trans('cruds.receiver.title_singular')." ".trans('messages.edit_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.receivers.index')->with($notification);
    }

    public function show(Receiver $receiver)
    {
        abort_if(Gate::denies('receivers_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.receiver.show');

        $status              = $this->status;
        return view('admin.receivers.show', compact('receiver','pageTitle','status'));
    }

    public function destroy(Receiver $receiver)
    {
        abort_if(Gate::denies('receivers_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $receiver->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.receiver.title_singular').' '.trans('messages.delete_success_message')], 200);        
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:receivers,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $receiver = Receiver::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.receiver.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }

}