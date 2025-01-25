<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VerificationProviderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationProvider\UpdateRequest;
use App\Models\VerificationProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VerificationProviderController extends Controller
{
    private $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(VerificationProviderDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.verification_provider.list');
        return $dataTable->render('admin.verification_provider.index', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = trans('panel.page_title.verification_provider.add');
        $status = $this->status;
        return view('admin.verification-provider.create', compact('pageTitle', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:verification_provider|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        VerificationProvider::create($request->all());

        return redirect()->route('admin.verification_provider.index')->with('success', 'Verification Provider created successfully!');
    }

    public function show(VerificationProvider $verificationprovider)
    {
        $pageTitle = trans('panel.page_title.verification_provider.show');
        $status = config('constant.enums.status');
        return view('admin.verification-provider.show', compact('verificationprovider', 'pageTitle', 'status'));
    }

    public function edit(VerificationProvider $verificationprovider)
    {
        $pageTitle = trans('panel.page_title.verification_provider.edit');
        $status = $this->status;
        return view('admin.verification-provider.edit', compact('verificationprovider', 'pageTitle', 'status'));
    }

    public function update(UpdateRequest $request, VerificationProvider $verificationprovider)
    {
        $verificationprovider->update($request->all());
        $notification = [
            'message' => trans('cruds.verification_provider.title_singular') . " " . trans('messages.edit_success_message'),
            'alert-type' => trans('panel.alert-type.success')
        ];
        return redirect()->route('admin.verification-provider.index')->with($notification);
    }

    public function destroy(VerificationProvider $verificationprovider)
    {
        $verificationprovider->delete();
        return response()->json([
            'success' => true,
            'message' => trans('cruds.verification_provider.title_singular') . ' ' . trans('messages.delete_success_message')
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:verification_provider,VerificationProviderID',
                ],
                'status' => [
                    'required',
                    'in:active,inactive',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray(),
                    'message' => 'Error Occurred!',
                ], 400);
            }

            $VerificationProvider = VerificationProvider::where('VerificationProviderID', $request->id)->update(['status' => $request->status]);

            $response = [
                'status' => 'true',
                'message' => trans('cruds.verification_provider.title_singular') . ' ' . trans('messages.change_status_success_message'),
            ];
            return response()->json($response);
        }
    }
}