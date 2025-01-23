<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\MassDestroyRequest;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Models\Permission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\DataTables\PermissionsDataTable;

class PermissionsController extends Controller
{

    public function index(PermissionsDataTable $dataTable)
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.permission.list_of_permission');
        return $dataTable->render('admin.permissions.index', compact('pageTitle'));
    }
    
    public function create()
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.permission.create_permission');
        return view('admin.permissions.create', compact('pageTitle'));
    }

    public function store(StoreRequest $request)
    {
        $permission = Permission::create($request->all());
        return redirect()->route('admin.permissions.index')->with('success',trans('cruds.permission.title_singular').' '.trans('messages.add_success_message'));
    }

    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.permission.edit_permission');
        return view('admin.permissions.edit', compact('permission', 'pageTitle'));
    }

    public function update(UpdateRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route('admin.permissions.index')->with('success',trans('cruds.permission.title_singular').' '.trans('messages.edit_success_message'));
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.permission.show_permission');
        return view('admin.permissions.show', compact('permission', 'pageTitle'));
    }

    public function destroy(Permission $permission, Request $request)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if($request->ajax()){
            $permission->delete();

            return $response = response()->json(['success' => true,
                'message' => trans('cruds.permission.title_singular').' '.trans('messages.delete_success_message')]);
        }        
    }

    public function massDestroy(MassDestroyRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
