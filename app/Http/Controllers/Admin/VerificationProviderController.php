<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\VerificationProviderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerificationProvider\StoreRequest;
use App\Http\Requests\VerificationProvider\UpdateRequest;
use App\Models\VerificationProvider;
use App\Models\Country;
use App\Models\ProviderType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

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
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    
    public function store(StoreRequest $request)
    {
        try {
            VerificationProvider::create($request->except('_token'));
            $errorMessage = $this->validateCountryStatus($request->country_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateCountryStatus($request->provider_type_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }

            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.verification_provider')]), 
            ['redirect_url' => route('admin.verification-providers.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }


    public function show($id){
        try{
            $verificationProvider = VerificationProvider::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.verification_provider.show');
            $status = $this->status;
            return view('admin.verification-providers.show', compact('verificationProvider', 'pageTitle'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $verificationProvider = VerificationProvider::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.verification_provider.edit');
            $status = $this->status;
            $countries = getActiveCountries(); 
            $providerTypes = getActiveProviderTypes();
            return view('admin.verification-providers.edit', compact('verificationProvider', 'pageTitle', 'status', 'countries', 'providerTypes'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, VerificationProvider $verificationProvider)
    {
       
        try {
            $errorMessage = $this->validateCountryStatus($request->country_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            $errorMessage = $this->validateProviderTypeStatus($request->provider_type_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            if ($request->status == '0') {
                $existenceCheck = $this->checkExistance($verificationProvider, true);
                if ($existenceCheck) {
                    return $existenceCheck;
                }
            }
            $verificationProvider->update($request->except('_token', '_method'));

            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.verification_provider')]), 
            ['redirect_url' => route('admin.verification-providers.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(VerificationProvider $verificationProvider)
    {
        try {
            $existenceCheck = $this->checkExistance($verificationProvider);
            if ($existenceCheck) {
                return $existenceCheck; 
            }
            $verificationProvider->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.verification_provider')]),
            ['redirect_url' => route('admin.verification-providers.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    private function checkExistance($verificationProvider, $forStatusUpdate = false)
    {
        if ($verificationProvider->services()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => $forStatusUpdate
                    ? __('messages.verificationProvider_associated_with_services') 
                    : __('messages.verification_provider_delete_error') 
            ], 400);
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
    private function validateProviderTypeStatus($providertypeId)
    {
        $providerType = ProviderType::find($providertypeId);

        if (!$providerType) {
            return __('messages.provider_type_not_found');
        }

        if ($providerType->status == 0) {
            return __('messages.provider_type_inactive');
        }

        return null; 
    }

}

