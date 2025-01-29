<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\DataTables\CountryDataTable;
use Illuminate\Support\Facades\Log; 

class CountryController extends Controller
{
    public function index(CountryDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.country.list');
        return $dataTable->render('admin.countries.index', compact('pageTitle'));
    }
    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.country.add');
            $status = config('constant.enums.status');
            return view('admin.countries.create', compact('pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in CountryController@create: ' . $e->getMessage());
            return redirect()->route('admin.countries.index')->with('error', 'An error occurred while preparing the create page.');
        }
    }
    public function store(Request $request){
    try {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:countries|max:255',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',
            'currency_name' => 'required|max:255',
            'currency_symbol' => [
                'required',
                'string',
                'max:10',
                'regex:/^[\p{Sc}\p{So}]*$/u',
            ],
            'status' => 'required|in:active,inactive',
        ], [
            'currency_symbol.regex' => 'The currency symbol must contain only valid currency symbols (e.g., $, €, £, ¥). Numbers, letters, and spaces are not allowed.',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        $flagPath = null;
        if ($request->hasFile('flag')) {
            $file = $request->file('flag');
            $filename = time() . '_' . $file->getClientOriginalName();
            $flagPath = $file->storeAs('public/flags', $filename);
            $flagPath = str_replace('public/', '', $flagPath);
        }
        Country::create([
            'name' => $request->name,
            'flag' => $flagPath,
            'description' => $request->description,
            'currency_name' => $request->currency_name,
            'currency_symbol' => $request->currency_symbol,
            'status' => $request->status,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Country created successfully!',
        ]);
    } catch (\Exception $e) {
        \Log::error('Error in CountryController@store: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'An error occurred while creating the country.',
        ], 500);
    }
}
    public function show(Country $country)
    {
        try {
            $pageTitle = trans('panel.page_title.country.show');
            $status = config('constant.enums.status');
            return view('admin.countries.show', compact('country', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in CountryController@show: ' . $e->getMessage());
            return redirect()->route('admin.countries.index')->with('error', 'An error occurred while fetching the country details.');
        }
    }
    public function edit(Country $country)
    {
        try {
            $pageTitle = trans('panel.page_title.country.edit');
            $status = config('constant.enums.status');
            return view('admin.countries.edit', compact('country', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in CountryController@edit: ' . $e->getMessage());
            return redirect()->route('admin.countries.index')->with('error', 'An error occurred while preparing the edit page.');
        }
    }
    public function update(Request $request, Country $country)
    {
        try {
            $request->validate([
                'name' => 'required|unique:countries,name,' . $country->CountryID . ',CountryID',
                'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'description' => 'nullable',
                'currency_name' => 'required|max:255',
                'currency_symbol' => 'required|max:10',
                'status' => 'required|in:active,inactive',
            ]);
            $flagPath = $country->flag; 
            if ($request->hasFile('flag')) {
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
            $notification = [
                'message' => trans('cruds.country.title_singular') . " " . trans('messages.edit_success_message'),
                'alert-type' => trans('panel.alert-type.success')
            ];

            return redirect()->route('admin.countries.index')->with($notification);
        } catch (\Exception $e) {
            Log::error('Error in CountryController@update: ' . $e->getMessage());
            return redirect()->route('admin.countries.index')->with('error', 'An error occurred while updating the country.');
        }
    }
    public function destroy(Country $country)
    {
        try {
            $country->delete();

            return response()->json([
                'success' => true,
                'message' => trans('cruds.country.title_singular') . ' ' . trans('messages.delete_success_message'),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in CountryController@destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the country.',
            ], 500);
        }
    }
    public function changeStatus(Request $request)
    {
        try {
            if ($request->ajax()) {
                $validator = \Validator::make($request->all(), [
                    'id' => [
                        'required',
                        'numeric',
                        'exists:countries,CountryID',
                    ],
                    'status' => [
                        'required',
                        'in:active,inactive',
                    ],
                ]);

                if (!$validator->passes()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray(),
                        'message' => 'Error Occurred!',
                    ], 400);
                }

                $country = Country::where('CountryID', $request->id)->update(['status' => $request->status]);

                $response = [
                    'status' => 'true',
                    'message' => trans('cruds.country.title_singular') . ' ' . trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        } catch (\Exception $e) {
            Log::error('Error in CountryController@changeStatus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while changing the status.',
            ], 500);
        }
    }
}
