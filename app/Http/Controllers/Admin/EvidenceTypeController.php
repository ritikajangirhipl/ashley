<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EvidenceTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvidenceType\StoreRequest;
use App\Http\Requests\EvidenceType\UpdateRequest;
use App\Models\EvidenceType;

class EvidenceTypeController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(EvidenceTypeDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.evidence_type.list');
        return $dataTable->render('admin.evidence-types.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.evidence_type.add');
            $status = $this->status;
            return view('admin.evidence-types.create', compact('pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            EvidenceType::create($request->all());
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.evidence_type')]),
            ['redirect_url' => route('admin.evidence-types.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(EvidenceType $evidenceType)
    {
        try {
            $pageTitle = trans('panel.page_title.evidence_type.show');
            $status = $this->status;
            return view('admin.evidence-types.show', compact('evidenceType', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(EvidenceType $evidenceType)
    {
        try {
            $pageTitle = trans('panel.page_title.evidence_type.edit');
            $status = $this->status;
            return view('admin.evidence-types.edit', compact('evidenceType', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, EvidenceType $evidenceType)
    {
        try {
            $evidenceType->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.evidence_type')]), 
            ['redirect_url' => route('admin.evidence-types.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(EvidenceType $evidenceType)
    {
        try {
            $evidenceType->delete();
            return jsonResponseWithMessage(200, 'Evidence Type deleted successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}
