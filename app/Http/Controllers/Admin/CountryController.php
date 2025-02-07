<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Requests\Country\UpdateRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        } catch (\Exception $e) {
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
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(Country $country)
    {
        try {
            $pageTitle = trans('panel.page_title.country.show');
            return view('admin.countries.show', compact('country', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(Country $country)
    {
        try {
            $pageTitle = trans('panel.page_title.country.edit');
            $status = $this->status;
            return view('admin.countries.edit', compact('country', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Country $country)
    {
        try {
            if ($request->status == 0 && $country->verificationProviders()->count() > 0) {
                return response()->json([
                    'status' => 400,
                    'message' => __('messages.country_associated_with_verification_providers', ['attribute' => __('attribute.country')])
                ], 400);
            }

            $flagPath = $this->uploadFlag($request, $country);

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
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    public function destroy(Country $country)
    {
        try {
            if ($country->verificationProviders()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => __('messages.country_delete_error', ['attribute' => __('attribute.country')])
                ], 400);
            }
            if ($country->flag && Storage::exists('public/' . $country->flag)) {
                Storage::delete('public/' . $country->flag);
            }
            $country->delete();
    
            return response()->json([
                'status' => true,
                'message' => __('messages.delete_success_message', ['attribute' => __('attribute.country')])
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('messages.unexpected_error') 
            ], 500);
        }
    }
    
    private function uploadFlag(Request $request, Country $country = null)
    {
        $flagPath = $country ? $country->flag : null;

        if ($request->hasFile('flag')) {
            // Delete the old flag file if it exists
            if ($country && $country->flag && Storage::exists('public/' . $country->flag)) {
                Storage::delete('public/' . $country->flag);
            }

            // Upload the new flag file
            $file = $request->file('flag');
            $filename = time() . '_' . $file->getClientOriginalName();
            $flagPath = $file->storeAs('public/flags', $filename);
            $flagPath = str_replace('public/', '', $flagPath);
        }

        return $flagPath;
    }
}
