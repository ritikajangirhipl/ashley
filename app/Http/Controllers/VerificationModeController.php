<?php
namespace App\Http\Controllers;

use App\DataTables\VerificationModeDatatable;
use App\Models\VerificationMode;
use Illuminate\Http\Request;

class VerificationModeController extends Controller
{
    // Display the DataTable view
    public function index(VerificationModeDatatable $dataTable)
    {
        return $dataTable->render('verification_modes.index');
    }

    // Show form to create a new verification mode
    public function create()
    {
        return view('verification_modes.create');
    }

    // Store the newly created verification mode
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:verification_modes|max:255',
            'description' => 'nullable',
            'status' => 'required|in:Active,Inactive',
        ]);

        VerificationMode::create($request->only(['name', 'description', 'status']));

        session()->flash('success', 'Verification Mode created successfully!');
        return redirect()->route('verification-modes.index');
    }

    // Show form to edit an existing verification mode
    public function edit(VerificationMode $verificationMode)
    {
        return view('verification_modes.edit', compact('verificationMode'));
    }

    // Update an existing verification mode
    public function update(Request $request, VerificationMode $verificationMode)
    {
        $request->validate([
            'name' => 'required|max:255|unique:verification_modes,name,' . $verificationMode->id,
            'description' => 'nullable',
            'status' => 'required|in:Active,Inactive',
        ]);

        $verificationMode->update($request->only(['name', 'description', 'status']));

        return redirect()->route('verification-modes.index');
    }

    // Delete a verification mode
    public function destroy(VerificationMode $verificationMode)
    {
        $verificationMode->delete();
        return response()->json(['success' => 'Verification Mode deleted successfully!']);
    }
}