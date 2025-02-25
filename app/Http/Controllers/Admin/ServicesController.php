<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ServicesController extends Controller
{
    protected $status;
    protected $subjects;
    protected $input_details;
    protected $field_types;
    protected $verification_duration_types;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
        $this->subjects = config('constant.enums.subjects');
        $this->input_details = config('constant.enums.input_details');
        $this->field_types = config('constant.enums.field_types');
        $this->verification_duration_types = config('constant.enums.verification_duration_types');
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
            $verificationDurationTypes = $this->verification_duration_types;
            $countries = getActiveCountries();
            $categories = getActiveCategories();
            $verificationModes = getVerificationModes();
            $verificationProviders = getVerificationProviders();
            $evidenceTypes = getEvidenceTypes();
            $servicePartners = getServicePartners();
            $subCategories = getActiveSubCategories();
            // $currencies = getCurrencies();
            return view('admin.services.create', compact('pageTitle', 'status', 'countries','categories','verificationModes','verificationProviders','subjects','evidenceTypes','servicePartners','inputDetailsOpts','fieldTypes','subCategories','verificationDurationTypes'));
        } catch (Exception $e) {
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
                    if($field['field_name'] && $field['field_type'] && $field['field_required']){
                        $service->additionalFields()->create([
                            'field_name' => $field['field_name'],
                            'field_type' => $field['field_type'],
                            'combo_values' => (isset($field['combo_values']) && !is_null($field['combo_values'])) ? json_encode($field['combo_values']) : NULL,
                            'field_required' => $field['field_required'],
                        ]);
                    }
                }
            }

            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.service')]), 
            ['redirect_url' => route('admin.services.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show($id)
    {
        try {
            $service = Service::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.service.show');
            $status = $this->status;
            $subjects = $this->subjects;
            $input_details = $this->input_details;
            $field_types = $this->field_types;
            $verificationDurationTypes = $this->verification_duration_types;
            return view('admin.services.show', compact('service', 'pageTitle', 'status','subjects','input_details','field_types','verificationDurationTypes'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $service = Service::where('id', decrypt($id))->firstOrFail();
            $pageTitle              = trans('panel.page_title.service.edit');
            $status                 = $this->status;
            $subjects               = $this->subjects;
            $inputDetailsOpts       = $this->input_details;
            $fieldTypes             = $this->field_types;
            $verificationDurationTypes = $this->verification_duration_types;
            $countries              = getActiveCountries();
            $categories             = getActiveCategories();
            $verificationModes      = getVerificationModes();
            $verificationProviders  = getVerificationProviders();
            $evidenceTypes          = getEvidenceTypes();
            $servicePartners        = getServicePartners();
            $subCategories          = getActiveSubCategories($service->category_id);
            return view('admin.services.edit', compact('service', 'pageTitle', 'status','countries','categories','verificationModes','verificationProviders','subjects','evidenceTypes','servicePartners','inputDetailsOpts','fieldTypes','subCategories','verificationDurationTypes'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Service $service)
    {
        try {
            $service->update($request->except('_token', '_method','additional_fields','deleted_fields'));

            $additionalFields = $request->additional_fields;
            if(!empty($additionalFields)){
                foreach($additionalFields as $key => $field){
                    $additionalFieldId = $field['additional_field_id'] ?? NULL;

                    $service->additionalFields()->updateOrCreate(['id' => $additionalFieldId],[
                        'field_name' => $field['field_name'] ?? null,
                        'field_type' => $field['field_type'] ?? null,
                        'combo_values' => (isset($field['combo_values']) && !is_null($field['combo_values'])) ? json_encode($field['combo_values']) : NULL,
                        'field_required' => isset($field['field_required']) ? $field['field_required'] : 0,
                    ]);
                }
            }

            if($request->deleted_fields){
                $deletedFields = explode(',',$request->deleted_fields);
                if(count($deletedFields) > 0){
                    $service->additionalFields()->whereIn('id',$deletedFields)->delete();
                }
            }

            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.service')]), 
            ['redirect_url' => route('admin.services.index')]);
        } catch (Exception $e) {
            // dd($e->getMessage().' '.$e->getFile().' '.$e->getCode());
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Service $service)
    {
        try {
            $service->additionalFields()->delete();
            $service->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.service')]),
            ['redirect_url' => route('admin.services.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    
}

