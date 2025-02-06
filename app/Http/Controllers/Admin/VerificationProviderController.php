<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VerificationProviderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationProvider\StoreRequest;
use App\Http\Requests\VerificationProvider\UpdateRequest;
use App\Models\VerificationProvider;

class VerificationProviderController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(VerificationProviderDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.verification_provider.list');
        return $dataTable->render('admin.verification-providers.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.verification_provider.add');
            $status = $this->status;
            $countries = getActiveCountries();
            $providerTypes = getActiveProviderTypes();
            return view('admin.verification-providers.create', compact('pageTitle','status', 'countries', 'providerTypes'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    
    public function store(StoreRequest $request)
    {
        try {
            VerificationProvider::create($request->except('_token'));

            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.verification_provider')]), 
            ['redirect_url' => route('admin.verification-providers.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }


    public function show(VerificationProvider $verificationProvider){
        try{
            $pageTitle = trans('panel.page_title.verification_provider.show');
            $status = $this->status;
            return view('admin.verification-providers.show', compact('verificationProvider', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(VerificationProvider $verificationProvider)
    {
        try {
            $pageTitle = trans('panel.page_title.verification_provider.edit');
            $status = $this->status;
            $countries = getActiveCountries(); 
            $providerTypes = getActiveProviderTypes();
            return view('admin.verification-providers.edit', compact('verificationProvider', 'pageTitle', 'status', 'countries', 'providerTypes'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, VerificationProvider $verificationProvider)
    {
       
        try {
            $verificationProvider->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.verification_provider')]), 
            ['redirect_url' => route('admin.verification-providers.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(VerificationProvider $verificationProvider)
    {
        try {
            $verificationProvider->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.verification_provider')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

}

