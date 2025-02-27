<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\ServicePartnerDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\ServicePartner\StoreRequest;
use App\Http\Requests\ServicePartner\UpdateRequest;
use App\Models\ServicePartner;
use App\Models\Country;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ServicePartnerController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(ServicePartnerDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.service_partners.list');
        return $dataTable->render('admin.service-partners.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.service_partners.add');
            $status = $this->status;
            $countries = getActiveCountries();
            return view('admin.service-partners.create', compact('pageTitle', 'status', 'countries'));
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $errorMessage = $this->validateCountryStatus($request->country_id);
            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.service_partners')]), 
            ['redirect_url' => route('admin.service-partners.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show($id)
    {
        try {
            $servicePartner = ServicePartner::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.service_partners.show');
            $status = $this->status;
            return view('admin.service-partners.show', compact('servicePartner', 'pageTitle', 'status'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $servicePartner = ServicePartner::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.service_partners.edit');
            $status = $this->status;
            $countries = getActiveCountries();
            return view('admin.service-partners.edit', compact('servicePartner', 'pageTitle', 'status', 'countries'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, ServicePartner $servicePartner)
    {
        try {

            $errorMessage = $this->validateCountryStatus($request->country_id);

            if ($errorMessage) {
                return jsonResponseWithMessage(400, $errorMessage, []);
            }
            if ($request->status == '0') {
                $existenceCheck = $this->checkExistance($servicePartner, true);
                if ($existenceCheck) {
                    return $existenceCheck;
                }
            }
            $servicePartner->update($request->except('_token', '_method'));

            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.service_partners')]), 
            ['redirect_url' => route('admin.service-partners.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(ServicePartner $servicePartner)
    {
        try {
            $existenceCheck = $this->checkExistance($servicePartner);
            if ($existenceCheck) {
                return $existenceCheck; 
            }

            $servicePartner->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.service_partners')]),
            ['redirect_url' => route('admin.service-partners.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    private function checkExistance($evidenceType, $forStatusUpdate = false)

    {
        if ($evidenceType->services()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => $forStatusUpdate
                    ? __('messages.servicePartner_associated_with_services')
                    : __('messages.service_partner_delete_error')
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
}

