<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProviderTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderType\StoreRequest;
use App\Http\Requests\ProviderType\UpdateRequest;
use App\Models\ProviderType;


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
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            ProviderType::create($request->all());
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.provider_type')]),
            ['redirect_url' => route('admin.provider-types.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(ProviderType $providerType)
    {
        try {
            $pageTitle = trans('panel.page_title.provider_type.show');
            $status = $this->status;
            return view('admin.provider-types.show', compact('providerType', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(ProviderType $providerType)
    {
        try {
            $pageTitle = trans('panel.page_title.provider_type.edit');
            $status = $this->status;
            return view('admin.provider-types.edit', compact('providerType', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    
    public function update(UpdateRequest $request, ProviderType $providerType)
    {
        try {
            if ($request->status == '0' && $providerType->verificationProviders()->count() > 0) {
                return response()->json([
                    'status' => 400,
                    'message' => __('messages.providerType_associated_with_verificationProviders', ['attribute' => __('attribute.provider_type')])
                ], 400);
            }

            $providerType->update($request->except('_token', '_method'));
    
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.provider_type')]),
            ['redirect_url' => route('admin.provider-types.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    

    public function destroy(ProviderType $providerType)
    {
        try {
            if ($providerType->verificationProviders()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => __('messages.provider_type_delete_error', ['attribute' => __('attribute.provider_type')])
                ], 400);
                
            }
            $providerType->delete();
    
            return response()->json([
                'status' => true,
                'message' => __('messages.delete_success_message', ['attribute' => __('attribute.provider_type')])
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('messages.unexpected_error')
            ], 500);
        }
    }
    
}

