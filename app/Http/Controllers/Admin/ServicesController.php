<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ServiceDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreRequest;
use App\Http\Requests\Service\UpdateRequest;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Country;
use App\Models\EvidenceType;
use App\Models\ServicePartner;
use App\Models\VerificationMode;
use App\Models\VerificationProvider;
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
            $errorMessage = $this->validateCategoryStatus($request->category_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateSubcategoryStatus($request->sub_category_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateEvidenceTypeStatus($request->evidence_type_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateCountryStatus($request->country_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateServicePartnerStatus($request->service_partner_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateVerificationModeStatus($request->verification_mode_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateVerificationProviderStatus($request->verification_provider_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $service = Service::create($request->except('_token','additional_fields'));
            $additionalFields = $request->additional_fields;
            if(!empty($additionalFields)){
                foreach($additionalFields as $key => $field){
                    if($field['field_name'] && $field['field_type'] && in_array($field['field_required'],[0,1])){
                        $service->additionalFields()->create([
                            'field_name' => $field['field_name'],
                            'field_type' => $field['field_type'],
                            'combo_values' => (isset($field['combo_values']) && !is_null($field['combo_values']) && $field['field_type'] == 2) ? json_encode($field['combo_values']) : NULL,
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
            $errorMessage = $this->validateCategoryStatus($request->category_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateEvidenceTypeStatus($request->evidence_type_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }

            $errorMessage = $this->validateCountryStatus($request->country_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }

            
            $errorMessage = $this->validateServicePartnerStatus($request->service_partner_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateVerificationModeStatus($request->verification_mode_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }

            $errorMessage = $this->validateVerificationProviderStatus($request->verification_provider_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }

            $errorMessage = $this->validateSubcategoryStatus($request->sub_category_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }

            $service->update($request->except('_token', '_method','additional_fields','deleted_fields'));

            $additionalFields = $request->additional_fields;
            if(!empty($additionalFields)){
                foreach($additionalFields as $key => $field){
                    $additionalFieldId = $field['additional_field_id'] ?? NULL;

                    if($field['field_name'] && $field['field_type'] && in_array($field['field_required'],[0,1])){
                        $service->additionalFields()->updateOrCreate(['id' => $additionalFieldId],[
                            'field_name' => $field['field_name'] ?? null,
                            'field_type' => $field['field_type'] ?? null,
                            'combo_values' => (isset($field['combo_values']) && !is_null($field['combo_values']) && $field['field_type'] == 2) ? json_encode($field['combo_values']) : NULL,
                            'field_required' => isset($field['field_required']) ? $field['field_required'] : 0,
                        ]);
                    }
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

    private function validateCategoryStatus($categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return __('messages.category_not_found');
        }

        if ($category->status == 0) {
            return __('messages.category_inactive');
        }

        return null; 
    }

    private function validateCountryStatus($countryId)
    {
        $country = Country::find($countryId);

        if (!$country) {
            return __('messages.country_not_found');
        }

        if ($country->status == 0) {
            return __('messages.country_inactive');
        }

        return null; 
    }

    private function validateEvidenceTypeStatus($evidencetypeId)
    {
        $evidenceType = EvidenceType::find($evidencetypeId);

        if (!$evidenceType) {
            return __('messages.evidence_type_not_found');
        }

        if ($evidenceType->status == 0) {
            return __('messages.evidence_type_inactive');
        }

        return null; 
    }

    private function validateServicePartnerStatus($servicepartnerId)
    {
        $servicePartner = ServicePartner::find($servicepartnerId);

        if (!$servicePartner) {
            return __('messages.service_partner_not_found');
        }

        if ($servicePartner->status == 0) {
            return __('messages.service_partner_inactive');
        }

        return null; 
    }
    
    private function validateVerificationModeStatus($verificationmodeId)
    {
        $verificationMode = VerificationMode::find($verificationmodeId);

        if (!$verificationMode) {
            return __('messages.verification_mode_not_found');
        }

        if ($verificationMode->status == 0) {
            return __('messages.verification_mode_inactive');
        }

        return null; 
    }

    private function validateVerificationProviderStatus($verificationproviderId)
    {
        $verificationProvider = VerificationProvider::find($verificationproviderId);

        if (!$verificationProvider) {
            return __('messages.verification_provider_not_found');
        }

        if ($verificationProvider->status == 0) {
            return __('messages.verification_provider_inactive');
        }

        return null; 
    }

    private function validateSubcategoryStatus($subcategoryId)
    {
        $subCategory = SubCategory::find($subcategoryId);

        if (!$subCategory) {
            return __('messages.subcategory_not_found');
        }

        if ($subCategory->status == 0) {
            return __('messages.subcategory_inactive');
        }

        return null; 
    }
    
    
}

