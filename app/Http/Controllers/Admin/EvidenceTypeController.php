<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvidenceType;
use Illuminate\Http\Request;
use App\DataTables\EvidenceTypeDataTable;
use App\Http\Requests\EvidenceType\UpdateRequest;
use Illuminate\Support\Facades\Log;

class EvidenceTypeController extends Controller
{
    public function index(EvidenceTypeDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.evidence_type.list');
        return $dataTable->render('admin.evidence-types.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.evidence_type.add');
            $status = config('constant.enums.status'); 
            return view('admin.evidence-types.create', compact('pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in EvidenceTypeController@create: ' . $e->getMessage());
            return redirect()->route('admin.evidence-types.index')->with('error', 'An error occurred while preparing the create page.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:evidence_types|max:255',
                'description' => 'nullable|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            EvidenceType::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Evidence Type created successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in EvidenceTypeController@store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the evidence type.',
            ], 500);
        }
    }

    public function show(EvidenceType $evidenceType)
    {
        try {
            $pageTitle = trans('panel.page_title.evidence_type.show');
            $status = config('constant.enums.status');
            return view('admin.evidence-types.show', compact('evidenceType', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in EvidenceTypeController@show: ' . $e->getMessage());
            return redirect()->route('admin.evidence-types.index')->with('error', 'An error occurred while fetching the evidence type details.');
        }
    }

    public function edit(EvidenceType $evidenceType)
    {
        try {
            $pageTitle = trans('panel.page_title.evidence_type.edit');
            $status = config('constant.enums.status');
            return view('admin.evidence-types.edit', compact('evidenceType', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in EvidenceTypeController@edit: ' . $e->getMessage());
            return redirect()->route('admin.evidence-types.index')->with('error', 'An error occurred while preparing the edit page.');
        }
    }

    public function update(Request $request, EvidenceType $evidenceType)
    {
        try {
            $request->validate([
                'name' => 'required|unique:evidence_types,name,' . $evidenceType->EvidenceTypeID . ',EvidenceTypeID|max:255',
                'description' => 'nullable|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            $evidenceType->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Evidence Type updated successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in EvidenceTypeController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the evidence type.',
            ], 500);
        }
    }

    public function destroy(EvidenceType $evidenceType)
    {
        try {
            $evidenceType->delete();

            return response()->json([
                'success' => true,
                'message' => trans('cruds.evidence_type.title_singular') . ' ' . trans('messages.delete_success_message'),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in EvidenceTypeController@destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the evidence type.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            if ($request->ajax()) {
                $validator = \Validator::make($request->all(), [
                    'id' => [
                        'required',
                        'numeric',
                        'exists:evidence_types,EvidenceTypeID',
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

                $evidenceType = EvidenceType::where('EvidenceTypeID', $request->id)->update(['status' => $request->status]);

                $response = [
                    'status' => 'true',
                    'message' => trans('cruds.evidence_type.title_singular') . ' ' . trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        } catch (\Exception $e) {
            Log::error('Error in EvidenceTypeController@changeStatus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while changing the status.',
            ], 500);
        }
    }
}
