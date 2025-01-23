<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\DataTables\StudentsDataTable;
use App\Models\HolderSubmission;

use Auth;
use Gate;
use Validator;

class BillVerifyPaymentsController extends Controller
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
        $this->paymentStatus = config('constant.enums.paymentStatus');
    }


    public function index(StudentsDataTable $dataTable)
    {
        abort_if(Gate::denies('bill_verify_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.bill_verify_payments.list');
        return $dataTable->render('admin.bill_verify_payment.index', compact('pageTitle'));
    }

    public function create(){
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle  = trans('panel.page_title.bill_verify_payments.add');
        $submission = HolderSubmission::pluck('submission_ref','id');
        $paymentStatus              = $this->paymentStatus;
        return view('admin.bill_verify_payment.create', compact('pageTitle','submission','paymentStatus'));
    }

    public function store(StoreRequest $request)
    {
        $student = Student::create($request->all());
        $notification = ['message' => trans('cruds.students.title_singular')." ".trans('messages.add_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.students.index')->with($notification);
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.students.edit');
        $status              = $this->status;
        return view('admin.students.edit', compact('student','pageTitle','status'));
    }

    public function update(UpdateRequest $request, Student $student)
    {
        $student->update($request->all());
        $notification = ['message' => trans('cruds.students.title_singular')." ".trans('messages.edit_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.students.index')->with($notification);
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.students.show');
        $status              = $this->status;
        return view('admin.students.show', compact('student','pageTitle','status'));
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $student->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.students.title_singular').' '.trans('messages.delete_success_message')], 200);        
    }

    public function changeStudentStatus(Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:students,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $student = Student::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.students.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }
}