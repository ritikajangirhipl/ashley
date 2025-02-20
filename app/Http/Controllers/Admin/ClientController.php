<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ClientDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\StoreRequest;
use App\Http\Requests\Client\UpdateRequest;
use App\Models\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class ClientController extends Controller
{
    protected $status;
    protected $clientTypes;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
        $this->clientTypes = config('constant.enums.client_type');
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
            $clientTypes = $this->clientTypes;
    
            return view('admin.clients.create', compact('pageTitle', 'status', 'countries', 'clientTypes'));
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $data = $request->except('_token', '_method');
            $data['password'] = Hash::make($request->password); 
            $data['email_verified_at'] = Carbon::now();
            Client::create($data);
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.client')]), 
            ['redirect_url' => route('admin.clients.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show($id)
    {
        try {
            $client = Client::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.client.show');
            $status = $this->status;
            return view('admin.clients.show', compact('client', 'pageTitle', 'status'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $client = Client::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.client.edit');
            $status = $this->status;
            $countries = getActiveCountries(); 
            $clientTypes = $this->clientTypes;
            return view('admin.clients.edit', compact('client', 'pageTitle', 'status', 'countries', 'clientTypes'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Client $client)
    {
        try {
            $data = $request->except('_token', '_method');
            $data['password'] = Hash::make($request->password); 
            $client->update($data);
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.client')]), 
            ['redirect_url' => route('admin.clients.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Client $client)
    {
        try {
            $client->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.client')]));
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}
