<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServicePartnerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicePartner\StoreRequest;
use App\Http\Requests\ServicePartner\UpdateRequest;
use App\Models\ServicePartner;

class ServicePartnerController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(ServicePartnerDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.service_partner.list');
        return $dataTable->render('admin.service-partners.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.service_partner.add');
            $status = $this->status;
            $countries = getActiveCountries();
            return view('admin.service-partners.create', compact('pageTitle', 'status', 'countries'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            ServicePartner::create($request->except('_token'));
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.service_partner')]), 
            ['redirect_url' => route('admin.service-partners.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(ServicePartner $servicePartner)
    {
        try {
            $pageTitle = trans('panel.page_title.service_partner.show');
            $status = $this->status;
            return view('admin.service-partners.show', compact('servicePartner', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(ServicePartner $servicePartner)
    {
        try {
            $pageTitle = trans('panel.page_title.service_partner.edit');
            $status = $this->status;
            $countries = getActiveCountries();
            return view('admin.service-partners.edit', compact('servicePartner', 'pageTitle', 'status', 'countries'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, ServicePartner $servicePartner)
    {
        try {
            $servicePartner->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.service_partner')]), 
            ['redirect_url' => route('admin.service-partners.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(ServicePartner $servicePartner)
    {
        try {
            $servicePartner->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.service_partner')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}

