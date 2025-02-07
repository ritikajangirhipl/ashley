<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClientDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;

class ClientController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(ClientDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.client.list');
        return $dataTable->render('admin.clients.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.client.add');
            $status = $this->status;
            $countries = getActiveCountries();
            $clientTypes = getActiveClientTypes();
    
            return view('admin.clients.create', compact('pageTitle', 'status', 'countries', 'clientTypes'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    

    public function store(StoreRequest $request)
    {
        try {
            Client::create($request->except('_token'));
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.client')]), 
            ['redirect_url' => route('admin.clients.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(Client $client)
    {
        try {
            $pageTitle = trans('panel.page_title.client.show');
            $status = $this->status;
            return view('admin.clients.show', compact('client', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(Client $client)
    {
        try {
            $pageTitle = trans('panel.page_title.client.edit');
            $status = $this->status;
            $countries = getActiveCountries(); 
            $clientTypes = getActiveClientTypes();
            return view('admin.clients.edit', compact('client', 'pageTitle', 'status', 'countries', 'clientTypes'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Client $client)
    {
        try {
            $client->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.client')]), 
            ['redirect_url' => route('admin.clients.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Client $client)
    {
        try {
            $client->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.client')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}
