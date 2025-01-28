<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use App\DataTables\CountryDataTable;

class CountryController extends Controller
{
    public function index(CountryDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.country.list');
        return $dataTable->render('admin.countries.index', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = trans('panel.page_title.country.add');
        $status = config('constant.enums.status'); 
        return view('admin.countries.create', compact('pageTitle', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
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

        // Handle file upload
        $flagPath = null;
        if ($request->hasFile('flag')) {
            $file = $request->file('flag');
            $filename = time() . '_' . $file->getClientOriginalName(); 
            $flagPath = $file->storeAs('public/flags', $filename); 
            $flagPath = str_replace('public/', '', $flagPath); 
        }

        // Create the country
        Country::create([
            'name' => $request->name,
            'flag' => $flagPath,
            'description' => $request->description,
            'currency_name' => $request->currency_name,
            'currency_symbol' => $request->currency_symbol,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.countries.index')->with('success', 'Country created successfully!');
    }
    public function show(Country $country)
    {
        $pageTitle = trans('panel.page_title.country.show');
        $status = config('constant.enums.status');
        return view('admin.countries.show', compact('country', 'pageTitle', 'status'));
    }

    public function edit(Country $country)
    {
        $pageTitle = trans('panel.page_title.country.edit');
        $status = config('constant.enums.status');
        return view('admin.countries.edit', compact('country', 'pageTitle', 'status'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|unique:countries,name,' . $country->CountryID . ',CountryID',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable',
            'currency_name' => 'required|max:255',
            'currency_symbol' => 'required|max:10',
            'status' => 'required|in:active,inactive',
        ]);

        // Handle file upload
        $flagPath = $country->flag; 
        if ($request->hasFile('flag')) {
            $file = $request->file('flag');
            $filename = time() . '_' . $file->getClientOriginalName(); 
            $flagPath = $file->storeAs('public/flags', $filename); 
            $flagPath = str_replace('public/', '', $flagPath); 
        }

        // Update the country
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
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json([
            'success' => true,
            'message' => trans('cruds.country.title_singular') . ' ' . trans('messages.delete_success_message'),
        ], 200);
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
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
    }
}