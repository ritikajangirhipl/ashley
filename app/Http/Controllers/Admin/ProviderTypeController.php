<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProviderTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderType\StoreRequest;
use App\Http\Requests\ProviderType\UpdateRequest;
use App\Models\ProviderType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;


class ProviderTypeController extends Controller
{
    protected $status;

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
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            ProviderType::create($request->all());
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.provider_type')]),
            ['redirect_url' => route('admin.provider-types.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show($id)
    {
        try {
            $providerType = ProviderType::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.provider_type.show');
            $status = $this->status;
            return view('admin.provider-types.show', compact('providerType', 'pageTitle'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $providerType = ProviderType::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.provider_type.edit');
            $status = $this->status;
            return view('admin.provider-types.edit', compact('providerType', 'pageTitle', 'status'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    
    public function update(UpdateRequest $request, ProviderType $providerType)
    {
        try {
            if ($request->status == '0') {
                $existenceCheck = $this->checkExistance($providerType, true);
                if ($existenceCheck) {
                    return $existenceCheck;
                }
            }

            $providerType->update($request->except('_token', '_method'));
    
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.provider_type')]),
            ['redirect_url' => route('admin.provider-types.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    

    public function destroy(ProviderType $providerType)
    {
        try {
            $existenceCheck = $this->checkExistance($providerType);
            if ($existenceCheck) {
                return $existenceCheck; 
            }
            $providerType->delete();
    
            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.provider_type')]),
            ['redirect_url' => route('admin.provider-types.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    private function checkExistance($providerType, $forStatusUpdate = false)

    {
        if ($providerType->verificationProviders()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => $forStatusUpdate
                    ? __('messages.providerType_associated_with_verificationProviders')
                    : __('messages.provider_type_delete_error')
            ], 400);
        }

        return null;
    }
    
    
}

