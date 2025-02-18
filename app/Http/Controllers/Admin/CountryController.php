<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Requests\Country\UpdateRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(CountryDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.country.list');
        return $dataTable->render('admin.countries.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.country.add');
            $status = $this->status;
            return view('admin.countries.create', compact('pageTitle', 'status'));
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $flagPath = $this->uploadFlag($request);
            Country::create([
                'name' => $request->name,
                'flag' => $flagPath,
                'description' => $request->description,
                'currency_name' => $request->currency_name,
                'currency_symbol' => $request->currency_symbol,
                'status' => $request->status,
            ]);

            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.country')]),
            ['redirect_url' => route('admin.countries.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show($id)
    {
        try {
            $country = Country::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.country.show');
            return view('admin.countries.show', compact('country', 'pageTitle'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $country = Country::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.country.edit');
            $status = $this->status;
            return view('admin.countries.edit', compact('country', 'pageTitle', 'status'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Country $country)
    {
        try {
            if ($request->status == '0') {
                $existenceCheck = $this->checkExistance($country);
                if ($existenceCheck) {
                    return $existenceCheck;
                }
            }

            $flagPath = $country->flag;

            if ($request->hasFile('flag')) {
                if ($country->flag && Storage::exists('public/' . $country->flag)) {
                    Storage::delete('public/' . $country->flag);
                }

                $file = $request->file('flag');
                $filename = time() . '_' . $file->getClientOriginalName();
                $flagPath = $file->storeAs('public/flags', $filename);
                $flagPath = str_replace('public/', '', $flagPath);
            }

            $country->update([
                'name' => $request->name,
                'flag' => $flagPath,
                'description' => $request->description,
                'currency_name' => $request->currency_name,
                'currency_symbol' => $request->currency_symbol,
                'status' => $request->status,
            ]);

            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.country')]), 
            ['redirect_url' => route('admin.countries.index')]);

        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Country $country)
    {
        try {
            $existenceCheck = $this->checkExistance($country);
            if ($existenceCheck) {
                return $existenceCheck; 
            }

            if ($country->flag && Storage::exists('public/' . $country->flag)) {
                Storage::delete('public/' . $country->flag);
            }

            $country->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.country')]));
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }
        
    private function checkExistance($country)
    {
        if ($country->verificationProviders()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => __('messages.country_cannot_be_deleted_due_to_verification_provider')
            ], 400);
        }

        if ($country->clients()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => __('messages.country_cannot_be_deleted_due_to_client')
            ], 400);
        }

        if ($country->servicePartners()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => __('messages.country_cannot_be_deleted_due_to_service_partner')
            ], 400);
        }

        return null;
    }
    private function uploadFlag(Request $request, Country $country = null)
    {
        $flagPath = $country ? $country->flag : null;

        if ($request->hasFile('flag')) {
            if ($country && $country->flag && Storage::exists('public/' . $country->flag)) {
                Storage::delete('public/' . $country->flag);
            }

            $file = $request->file('flag');
            $filename = time() . '_' . $file->getClientOriginalName();
            $flagPath = $file->storeAs('public/flags', $filename);
            $flagPath = str_replace('public/', '', $flagPath);
        }

        return $flagPath;
    }

    public function getCountryDetail(Request $request)
    {
        $country = Country::select('id','name','currency_name')->where('id',$request->country_id)->first();
        if($country){

            return response()->json([
                'status' => 400,
                'message' => __('attribute.country'),
                'data' => $country,
            ], 200);
        }else{
            return response()->json([
                'status' => 400,
                'message' => __('messages.record_not_found',['record' => __('attribute.country')])
            ], 400);
        }

    }
}
