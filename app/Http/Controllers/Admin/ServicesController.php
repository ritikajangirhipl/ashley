<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Models\Service;

class ServicesController extends Controller
{
    protected $status;
    protected $subjects;
    protected $input_details;
    protected $field_types;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
        $this->subjects = config('constant.enums.subjects');
        $this->input_details = config('constant.enums.input_details');
        $this->field_types = config('constant.enums.field_types');
    }

    public function index(ServiceDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.service.list');
        return $dataTable->render('admin.services.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.service.add');
            $status = $this->status;
            $subjects = $this->subjects;
            $inputDetailsOpts = $this->input_details;
            $fieldTypes = $this->field_types;
            $countries = getActiveCountries();
            $categories = getActiveCategories();
            $verificationModes = getVerificationModes();
            $verificationProviders = getVerificationProviders();
            $evidenceTypes = getEvidenceTypes();
            $servicePartners = getServicePartners();
            // $currencies = getCurrencies();
            return view('admin.services.create', compact('pageTitle', 'status', 'countries','categories','verificationModes','verificationProviders','subjects','evidenceTypes','servicePartners','inputDetailsOpts','fieldTypes'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $service = Service::create($request->except('_token','additional_fields'));
            $additionalFields = $request->additional_fields;
            if(!empty($additionalFields)){
                foreach($additionalFields as $key => $field){
                    $service->additionalFields()->create([
                        'field_name' => $field['field_name'],
                        'field_type' => $field['field_type'],
                        'combo_values' => (isset($field['combo_values']) && !is_null($field['combo_values'])) ? json_encode($field['combo_values']) : NULL,
                        'field_required' => $field['field_required'],
                    ]);
                }
            }

            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.service')]), 
            ['redirect_url' => route('admin.services.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(Service $service)
    {
        try {
            $pageTitle = trans('panel.page_title.service.show');
            $status = $this->status;
            return view('admin.services.show', compact('service', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(Service $service)
    {
        try {
            $pageTitle = trans('panel.page_title.service.edit');
            $status = $this->status;
            $subjects = $this->subjects;
            $inputDetailsOpts = $this->input_details;
            $fieldTypes = $this->field_types;
            $countries = getActiveCountries();
            $categories = getActiveCategories();
            $verificationModes = getVerificationModes();
            $verificationProviders = getVerificationProviders();
            $evidenceTypes = getEvidenceTypes();
            $servicePartners = getServicePartners();
            return view('admin.services.edit', compact('service', 'pageTitle', 'status','countries','categories','verificationModes','verificationProviders','subjects','evidenceTypes','servicePartners','inputDetailsOpts','fieldTypes'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Service $service)
    {
        try {
            $service->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.service')]), 
            ['redirect_url' => route('admin.services.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Service $service)
    {
        try {
            $service->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.service')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    
}

