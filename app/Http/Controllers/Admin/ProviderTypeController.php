<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\ProviderTypeDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProviderType\UpdateRequest;
use App\Http\Requests\ProviderType\StoreRequest;
use App\Models\ProviderType;
use Illuminate\Http\Request;

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
        $pageTitle = trans('panel.page_title.provider_type.add');
        $status = $this->status;
        return view('admin.provider-types.create', compact('pageTitle', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:provider_types|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $providerType = ProviderType::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Provider Type created successfully!',
        ]);
    }

    public function edit(ProviderType $providerType)
    {
        $pageTitle = trans('panel.page_title.provider_type.edit');
        $status = $this->status;
        return view('admin.provider-types.edit', compact('providerType', 'pageTitle', 'status'));
    }
    public function update(UpdateRequest $request, ProviderType $providerType)
    {
        $providerType->update($request->validated());

        $notification = [
            'message' => trans('cruds.provider_type.title_singular') . " " . trans('messages.edit_success_message'),
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.provider-types.index')->with($notification);
    }

    
    public function show(ProviderType $providerType)
    {
        $pageTitle = trans('panel.page_title.provider_type.show');
        $status = config('constant.enums.status'); 
        return view('admin.provider-types.show', compact('providerType', 'pageTitle', 'status'));
    }

    public function destroy(ProviderType $providerType)
    {
        $providerType->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.provider_type.title_singular').' '.trans('messages.delete_success_message')], 200);
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:provider_type,id',
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
    }

}