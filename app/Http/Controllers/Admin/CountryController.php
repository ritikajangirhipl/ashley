<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Requests\Country\UpdateRequest;
use App\Http\Requests\Country\StatusRequest;
use App\Models\Country;
use App\Helpers\Helper;
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
            // Handle flag upload
            $flagPath = $this->uploadFlag($request);
            $status = $this->status;
            // Create the country
            Country::create([
                'name' => $request->name,
                'flag' => $flagPath,
                'description' => $request->description,
                'currency_name' => $request->currency_name,
                'currency_symbol' => $request->currency_symbol,
                'status' => $request->status,
            ]);

            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.country')]));
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
            // Handle flag upload
            $flagPath = $this->uploadFlag($request, $country);

            // Update the country
            $country->update([
                'name' => $request->name,
                'flag' => $flagPath,
                'description' => $request->description,
                'currency_name' => $request->currency_name,
                'currency_symbol' => $request->currency_symbol,
                'status' => $request->status,
            ]);

            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.country')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Country $country)
    {
        try {
            // Delete the flag file if it exists
            if ($country->flag && Storage::exists('public/' . $country->flag)) {
                Storage::delete('public/' . $country->flag);
            }

            $country->delete();
            return jsonResponseWithMessage(200, 'Country deleted successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function changeStatus(StatusRequest $request)
    {
        try {
            $status = $request->status == 1 ? 'active' : 'inactive';

            $country = Country::where('id', $request->id)->update(['status' => $status]);
            return jsonResponseWithMessage(200, 'Country status updated successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    /**
     * Handle flag upload.
     *
     * @param Request $request
     * @param Country|null $country
     * @return string|null
     */
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
