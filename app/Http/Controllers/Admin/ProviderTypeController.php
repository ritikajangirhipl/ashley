<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProviderTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderType\UpdateRequest;
use App\Http\Requests\ProviderType\StoreRequest;
use App\Models\ProviderType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 

class ProviderTypeController extends Controller
{
    private $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(ProviderTypeDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.provider_type.list');
        return $dataTable->render('admin.provider-types.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.provider_type.add');
            $status = $this->status;
            return view('admin.provider-types.create', compact('pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in ProviderTypeController@create: ' . $e->getMessage());
            return redirect()->route('admin.provider-types.index')->with('error', 'An error occurred while preparing the create page.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:provider_types|max:255',
                'description' => 'required',
                'status' => 'required|in:active,inactive',
            ]);

            ProviderType::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Provider Type created successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in ProviderTypeController@store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the provider type.',
            ], 500);
        }
    }

    public function edit(ProviderType $providerType)
    {
        try {
            $pageTitle = trans('panel.page_title.provider_type.edit');
            $status = $this->status;
            return view('admin.provider-types.edit', compact('providerType', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in ProviderTypeController@edit: ' . $e->getMessage());
            return redirect()->route('admin.provider-types.index')->with('error', 'An error occurred while preparing the edit page.');
        }
    }

    public function update(UpdateRequest $request, ProviderType $providerType)
    {
        try {
            $providerType->update($request->except('_token', '_method'));

            return response()->json([
                'success' => true,
                'message' => 'Provider Type updated successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in ProviderTypeController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the provider type.',
            ], 500);
        }
    }

    public function show(ProviderType $providerType)
    {
        try {
            $pageTitle = trans('panel.page_title.provider_type.show');
            $status = config('constant.enums.status');
            return view('admin.provider-types.show', compact('providerType', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in ProviderTypeController@show: ' . $e->getMessage());
            return redirect()->route('admin.provider-types.index')->with('error', 'An error occurred while fetching the provider type details.');
        }
    }

    public function destroy(ProviderType $providerType)
    {
        try {
            $providerType->delete();
            return response()->json([
                'success' => true,
                'message' => trans('cruds.provider_type.title_singular') . ' ' . trans('messages.delete_success_message'),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in ProviderTypeController@destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the provider type.',
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
                        'exists:provider_types,id',
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

                $providerType = ProviderType::where('id', $request->id)->update(['status' => $request->status]);

                $response = [
                    'status' => 'true',
                    'message' => trans('cruds.provider_type.title_singular') . ' ' . trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        } catch (\Exception $e) {
            Log::error('Error in ProviderTypeController@changeStatus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while changing the status.',
            ], 500);
        }
    }
}
