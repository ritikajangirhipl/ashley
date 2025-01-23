<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LevelMaster\StoreRequest;
use App\Http\Requests\LevelMaster\UpdateRequest;
use App\Models\LevelMaster;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Validator;

use App\DataTables\LevelMastersDataTable;

class LevelMastersController extends Controller
{

    public function index(LevelMastersDataTable $dataTable)
    {
        abort_if(Gate::denies('level_master_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.master.levels.list');
        return $dataTable->render('admin.master.levels.index', compact('pageTitle'));
    }

    public function create()
    {
        abort_if(Gate::denies('level_master_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $html = view('admin.master.levels.create')->render();
        return response()->json(['html' => $html]);
    }

    public function store(StoreRequest $request)
    {
        LevelMaster::create($request->all());
        return response()->json(['success' => true, 'message' => trans('cruds.levels.title_singular').' '.trans('messages.add_success_message')], 200);    
    }

    public function edit(LevelMaster $levelMaster)
    {
        abort_if(Gate::denies('level_master_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $html = view('admin.master.levels.edit', compact('levelMaster'))->render();
        return response()->json(['html' => $html]);
    }

    public function update(UpdateRequest $request, LevelMaster $levelMaster)
    {
        $levelMaster->update($request->all());
        return response()->json(['success' => true, 'message' => trans('cruds.levels.title_singular').' '.trans('messages.edit_success_message')], 200);
    }

    public function show(LevelMaster $levelMaster)
    {
        abort_if(Gate::denies('level_master_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = $levelMaster->title ?? '';
        return view('admin.master.levels.show', compact('levelMaster', 'pageTitle'));
    }

    public function destroy(LevelMaster $levelMaster)
    {
        abort_if(Gate::denies('level_master_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $levelMaster->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.levels.title_singular').' '.trans('messages.delete_success_message')], 200);        
    }
}