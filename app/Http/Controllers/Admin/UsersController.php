<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\MassDestroyRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Auth;
use Hash;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\DataTables\UsersDataTable;


class UsersController extends Controller
{

    public function index(UsersDataTable $dataTable)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.user.list_of_user');
        return $dataTable->render('admin.users.index', compact('pageTitle'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $pageTitle = trans('panel.page_title.user.create_user');
        return view('admin.users.create', compact('roles','pageTitle'));
    }

    public function store(StoreRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync(2);

        return redirect()->route('admin.users.index');

    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pageTitle = trans('panel.page_title.user.edit_user');
        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user','pageTitle'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');

    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.user.show_user');
        $user->load('roles');
        
        return view('admin.users.show', compact('user','pageTitle'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();

    }

    public function massDestroy(MassDestroyRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

}
