<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationMode;
use Illuminate\Http\Request;
use App\DataTables\VerificationModeDataTable;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class VerificationModeController extends Controller
{
    public function index(VerificationModeDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.verification_mode.list');
        return $dataTable->render('admin.verification-modes.index', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = trans('panel.page_title.verification_mode.add');
        $status = config('constant.enums.status'); 
        return view('admin.verification-modes.create', compact('pageTitle', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:verification_modes|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        VerificationMode::create($request->all());

        return redirect()->route('admin.verification-modes.index')->with('success', 'Verification Mode created successfully!');
    }

    public function show(VerificationMode $verificationMode)
    {
        $pageTitle = trans('panel.page_title.verification_mode.show');
        $status = config('constant.enums.status');
        return view('admin.verification-modes.show', compact('verificationMode', 'pageTitle', 'status'));
    }

    public function edit(VerificationMode $verificationMode)
    {
        $pageTitle = trans('panel.page_title.verification_mode.edit');
        $status = config('constant.enums.status');
        return view('admin.verification-modes.edit', compact('verificationMode', 'pageTitle', 'status'));
    }

    public function update(Request $request, VerificationMode $verificationMode)
    {
        $request->validate([
            'name' => 'required|unique:verification_modes,name,' . $verificationMode->ModeID . ',ModeID',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $verificationMode->update($request->all());

        return redirect()->route('admin.verification-modes.index')->with('success', 'Verification Mode updated successfully!');
    }

    public function destroy(VerificationMode $verificationMode)
    {

        $verificationMode->delete();

        return response()->json([
            'success' => true,
            'message' => trans('cruds.verification_mode.title_singular') . ' ' . trans('messages.delete_success_message'),
        ], 200);
    }

    public function changeStatus(Request $request)
    {
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
    }
}