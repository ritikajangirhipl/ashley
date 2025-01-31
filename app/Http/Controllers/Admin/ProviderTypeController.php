<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProviderTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderType\StoreRequest;
use App\Http\Requests\ProviderType\UpdateRequest;
use App\Http\Requests\ProviderType\StatusRequest;
use App\Models\ProviderType;
use App\Helpers\Helper;
use Illuminate\Http\Request;

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
            $status = $this->status;
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.provider_type')]));
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
            $providerType->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.provider_type')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(ProviderType $providerType)
    {
        try {
            $providerType->delete();
            return jsonResponseWithMessage(200, 'Provider Type deleted successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function changeStatus(StatusRequest $request)
    {
        try {
            $status = $request->status == 1 ? 'active' : 'inactive';

            $providerType = ProviderType::where('id', $request->id)->update(['status' => $status]);
            return jsonResponseWithMessage(200, 'Provider Type status updated successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}

