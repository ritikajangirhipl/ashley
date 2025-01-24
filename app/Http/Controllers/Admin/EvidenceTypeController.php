<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvidenceType;
use Illuminate\Http\Request;
use App\DataTables\EvidenceTypeDataTable;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class EvidenceTypeController extends Controller
{
    public function index(EvidenceTypeDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.evidence_types.list');
        return $dataTable->render('admin.evidence-types.index', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = trans('panel.page_title.evidence_types.add');
        $status = config('constant.enums.status'); 
        return view('admin.evidence-types.create', compact('pageTitle', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:evidence_types|max:255',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);

        EvidenceType::create($request->all());

        return redirect()->route('admin.evidence-types.index')->with('success', 'Evidence Type created successfully!');
    }

    public function show(EvidenceType $evidenceType)
    {
        $pageTitle = trans('panel.page_title.evidence_types.show');
        $status = config('constant.enums.status');
        return view('admin.evidence-types.show', compact('evidenceType', 'pageTitle', 'status'));
    }

    public function edit(EvidenceType $evidenceType)
    {
        $pageTitle = trans('panel.page_title.evidence_types.edit');
        $status = config('constant.enums.status');
        return view('admin.evidence-types.edit', compact('evidenceType', 'pageTitle', 'status'));
    }

    public function update(Request $request, EvidenceType $evidenceType)
    {
        $request->validate([
            'name' => 'required|unique:evidence_types,name,' . $evidenceType->EvidenceTypeID . ',EvidenceTypeID',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);

        $evidenceType->update($request->all());

        return redirect()->route('admin.evidence-types.index')->with('success', 'Evidence Type updated successfully!');
    }

    public function destroy(EvidenceType $evidenceType)
    {
        $evidenceType->delete();

        return response()->json([
            'success' => true,
            'message' => trans('cruds.evidence_type.title_singular') . ' ' . trans('messages.delete_success_message'),
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
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
    }
}