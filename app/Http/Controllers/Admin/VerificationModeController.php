<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationMode;
use Illuminate\Http\Request;
use App\Http\Requests\VerificationMode\UpdateRequest;
use App\Http\Requests\VerificationMode\StoreRequest;
use App\DataTables\VerificationModeDataTable;
use Illuminate\Support\Facades\Log;

class VerificationModeController extends Controller
{
    public function index(VerificationModeDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.verification_mode.list');
        return $dataTable->render('admin.verification-modes.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.verification_mode.add');
            $status = config('constant.enums.status');
            return view('admin.verification-modes.create', compact('pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in VerificationModeController@create: ' . $e->getMessage());
            return redirect()->route('admin.verification-modes.index')->with('error', 'An error occurred while preparing the create page.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:verification_modes|max:255',
                'description' => 'required|max:255',
                'status' => 'required|in:active,inactive',
            ]);

            VerificationMode::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Verification Mode created successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in VerificationModeController@store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the verification mode.',
            ], 500);
        }
    }

    public function show(VerificationMode $verificationMode)
    {
        try {
            $pageTitle = trans('panel.page_title.verification_mode.show');
            $status = config('constant.enums.status');
            return view('admin.verification-modes.show', compact('verificationMode', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in VerificationModeController@show: ' . $e->getMessage());
            return redirect()->route('admin.verification-modes.index')->with('error', 'An error occurred while fetching the verification mode details.');
        }
    }

    public function edit(VerificationMode $verificationMode)
    {
        try {
            $pageTitle = trans('panel.page_title.verification_mode.edit');
            $status = config('constant.enums.status');
            return view('admin.verification-modes.edit', compact('verificationMode', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in VerificationModeController@edit: ' . $e->getMessage());
            return redirect()->route('admin.verification-modes.index')->with('error', 'An error occurred while preparing the edit page.');
        }
    }

    public function update(UpdateRequest $request, VerificationMode $verificationMode)
    {
        try {
            $verificationMode->update($request->except('_token', '_method'));

            return response()->json([
                'success' => true,
                'message' => 'Verification Mode updated successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in VerificationModeController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the verification mode.',
            ], 500);
        }
    }

    public function destroy(VerificationMode $verificationMode)
    {
        try {
            $verificationMode->delete();

            return response()->json([
                'success' => true,
                'message' => trans('cruds.verification_mode.title_singular') . ' ' . trans('messages.delete_success_message'),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in VerificationModeController@destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the verification mode.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            if ($request->ajax()) {
                $validator = Validator::make($request->all(), [
                    'id' => [
                        'required',
                        'numeric',
                        'exists:verification_modes,ModeID',
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

                $verificationMode = VerificationMode::where('ModeID', $request->id)->update(['status' => $request->status]);

                $response = [
                    'status' => 'true',
                    'message' => trans('cruds.verification_mode.title_singular') . ' ' . trans('messages.change_status_success_message'),
                ];

                return response()->json($response);
            }
        } catch (\Exception $e) {
            Log::error('Error in VerificationModeController@changeStatus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while changing the status.',
            ], 500);
        }
    }
}
