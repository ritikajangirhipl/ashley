<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\EvidenceTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvidenceType\StoreRequest;
use App\Http\Requests\EvidenceType\UpdateRequest;
use App\Models\EvidenceType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

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
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            EvidenceType::create($request->all());
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.evidence_type')]),
            ['redirect_url' => route('admin.evidence-types.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show($id)
    {
        try {
            $evidenceType = EvidenceType::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.evidence_type.show');
            $status = $this->status;
            return view('admin.evidence-types.show', compact('evidenceType', 'pageTitle'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $evidenceType = EvidenceType::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.evidence_type.edit');
            $status = $this->status;
            return view('admin.evidence-types.edit', compact('evidenceType', 'pageTitle', 'status'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, EvidenceType $evidenceType)
    {
        try {
            if ($request->status == '0') {
                $existenceCheck = $this->checkExistance($evidenceType, true);
                if ($existenceCheck) {
                    return $existenceCheck;
                }
            }
            $evidenceType->update($request->except('_token', '_method'));

            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.evidence_type')]), 
            ['redirect_url' => route('admin.evidence-types.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(EvidenceType $evidenceType)
    {
        try {
            $existenceCheck = $this->checkExistance($evidenceType);
            if ($existenceCheck) {
                return $existenceCheck; 
            }
            $evidenceType->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.evidence_type')]),
            ['redirect_url' => route('admin.evidence-types.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    private function checkExistance($evidenceType, $forStatusUpdate = false)

    {
        if ($evidenceType->services()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => $forStatusUpdate
                    ? __('messages.evidenceType_associated_with_services')
                    : __('messages.evidence_type_delete_error')
            ], 400);
        }

        return null;
    }
}
