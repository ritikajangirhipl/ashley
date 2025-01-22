<?php
namespace App\Http\Controllers;
use App\DataTables\CountryDataTable;
use App\Models\Country;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    // Display the DataTable view
    public function index(CountryDataTable $dataTable)
    {
        return $dataTable->render('countries.index');
    }

    // Show form to create a new country
    public function create()
    {
        return view('countries.create');
    }

    // Show details of a specific country
    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    // Store the newly created country
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:countries|max:255',
            'flag' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'required',
            'currency_name' => 'required|max:255',
            'currency_symbol' => 'required|max:10',
            'status' => 'required|in:active,inactive',
        ]);

        // Upload flag image and store the path
        $flagPath = $request->file('flag')->store('flags', 'public');

        // Create country
        Country::create([
            'name' => $request->name,
            'flag' => $flagPath,
            'description' => $request->description,
            'currency_name' => $request->currency_name,
            'currency_symbol' => $request->currency_symbol,
            'status' => $request->status,
        ]);

        // Flash success message and redirect to index page
        session()->flash('success', 'Country created successfully!');
        return redirect()->route('countries.index');
    }

    // Show form to edit an existing country
    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    // Update an existing country
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|max:255|unique:countries,name,' . $country->id,
            'flag' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'description' => 'required',
            'currency_name' => 'required|max:255',
            'currency_symbol' => 'required|max:10',
            'status' => 'required|in:active,inactive',
        ]);

        // If flag image is updated, upload and delete the old image
        if ($request->hasFile('flag')) {
            if ($country->flag && Storage::disk('public')->exists($country->flag)) {
                Storage::disk('public')->delete($country->flag);
            }
            $flagPath = $request->file('flag')->store('flags', 'public');
            $country->flag = $flagPath;
        }

        // Update country
        $country->update($request->all());

        return redirect()->route('countries.index');
    }

    // Delete a country
    public function destroy(Country $country)
    {
        // Delete the flag image if exists
        if ($country->flag && Storage::disk('public')->exists($country->flag)) {
            Storage::disk('public')->delete($country->flag);
        }

        // Delete country record
        $country->delete();

        return response()->json(['success' => 'Country deleted successfully!']);
    }
}