<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VerificationModeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationMode\StoreRequest;
use App\Http\Requests\VerificationMode\UpdateRequest;
use App\Models\VerificationMode;

class VerificationModeController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(VerificationModeDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.verification_mode.list');
        return $dataTable->render('admin.verification-modes.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.verification_mode.add');
            $status = $this->status;
            return view('admin.verification-modes.create', compact('pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            VerificationMode::create($request->all());
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.verification_mode')]), 
            ['redirect_url' => route('admin.verification-modes.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(VerificationMode $verificationMode)
    {
        try {
            $pageTitle = trans('panel.page_title.verification_mode.show');
            $status = $this->status;
            return view('admin.verification-modes.show', compact('verificationMode', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(VerificationMode $verificationMode)
    {
        try {
            $pageTitle = trans('panel.page_title.verification_mode.edit');
            $status = $this->status;
            return view('admin.verification-modes.edit', compact('verificationMode', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, VerificationMode $verificationMode)
    {
        try {
            $verificationMode->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.verification_mode')]),
            ['redirect_url' => route('admin.verification-modes.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(VerificationMode $verificationMode)
    {
        try {
            $verificationMode->delete();
            return jsonResponseWithMessage(200, 'Verification Mode deleted successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}
