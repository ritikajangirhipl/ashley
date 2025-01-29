<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VerificationProviderDataTable;
use App\Http\Controllers\Controller;
use App\Models\VerificationProvider;
use App\Models\Country;
use App\Models\ProviderType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
        return $dataTable->render('admin.verification-providers.index', compact('pageTitle'));

    }

    public function create()
    {
        $countries = Country::where('status', 'active')->pluck('name', 'id'); // Assuming you have a `Country` model
        $providerTypes = ProviderType::pluck('name', 'id'); // Assuming you have a `ProviderType` model
        return view('admin.verification-providers.create', compact('countries', 'providerTypes'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:verification_providers|max:255',
                'description' => 'nullable|max:500',
                'status' => 'required|in:active,inactive',
            ]);

            VerificationProvider::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Verification Provider created successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in VerificationProviderController@store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the verification provider.',
            ], 500);
        }
    }

    public function edit(VerificationProvider $verificationProvider)
    {
        try {
            $pageTitle = trans('panel.page_title.verification_provider.edit');
            $status = $this->status;
            return view('admin.verification-providers.edit', compact('verificationProvider', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in VerificationProviderController@edit: ' . $e->getMessage());
            return redirect()->route('admin.verification-providers.index')->with('error', 'An error occurred while preparing the edit page.');
        }
    }

    public function update(Request $request, VerificationProvider $verificationProvider)
    {
        try {
            $request->validate([
                'name' => 'required|unique:verification_providers,name,' . $verificationProvider->id,
                'description' => 'nullable|max:500',
                'status' => 'required|in:active,inactive',
            ]);

            $verificationProvider->update($request->all());

            return response()->json([
                'success' => true,
                'message' => trans('messages.edit_success_message'),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in VerificationProviderController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the verification provider.',
            ], 500);
        }
    }

    public function destroy(VerificationProvider $verificationProvider)
    {
        try {
            $verificationProvider->delete();
            return response()->json([
                'success' => true,
                'message' => trans('messages.delete_success_message'),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in VerificationProviderController@destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the verification provider.',
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
                        'exists:verification_providers,id',
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

                $verificationProvider = VerificationProvider::where('id', $request->id)->update(['status' => $request->status]);

                $response = [
                    'status' => 'true',
                    'message' => trans('cruds.verification_providers.title_singular') . ' ' . trans('messages.change_status_success_message'),
                ];

                return response()->json($response);
            }
        } catch (\Exception $e) {
            Log::error('Error in VerificationProviderController@changeStatus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while changing the status.',
            ], 500);
        }
    }
}
