<?php
namespace App\Http\Controllers;

use App\DataTables\ProviderTypeDataTable;
use App\Models\ProviderType;
use Illuminate\Http\Request;

class ProviderTypeController extends Controller
{
    // Display the DataTable view
    public function index(ProviderTypeDataTable $dataTable)
    {
        return $dataTable->render('provider_types.index');
    }
    // Show form to create a new provider type
    public function create()
    {
        return view('provider_types.create');
    }

    // Store the newly created provider type
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:provider_types|max:255',
            'description' => 'nullable',
            'status' => 'required|in:Active,Inactive',
        ]);

        ProviderType::create($request->only(['name', 'description', 'status']));

        session()->flash('success', 'Provider Type created successfully!');
        return redirect()->route('provider-types.index');
    }

    // Show form to edit an existing provider type
    public function edit(ProviderType $providerType)
    {
        return view('provider_types.edit', compact('providerType'));
    }

    // Update an existing provider type
    public function update(Request $request, ProviderType $providerType)
    {
        $request->validate([
            'name' => 'required|max:255|unique:provider_types,name,' . $providerType->id,
            'description' => 'nullable',
            'status' => 'required|in:Active,Inactive',
        ]);

        $providerType->update($request->only(['name', 'description', 'status']));

        return redirect()->route('provider-types.index');
    }

    // Delete a provider type
    public function destroy(ProviderType $providerType)
    {
        $providerType->delete();
        return response()->json(['success' => 'Provider Type deleted successfully!']);
    }
}