<?php
namespace App\Http\Controllers;

use App\DataTables\SubCategoryDataTable;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    // Display the DataTable view
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('subcategories.index');
    }

    // Show form to create a new subcategory
    public function create()
    {
        $categories = Category::all();
        // dd($categories);
        return view('subcategories.create', compact('categories'));
    }

    // Store the newly created subcategory
    public function store(Request $request)
    {
        $request->validate([
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Name' => 'required|unique:sub_categories|max:255',
            'Description' => 'required',
            'Status' => 'required|in:Active,Inactive',
        ]);

        SubCategory::create($request->all());

        session()->flash('success', 'SubCategory created successfully!');
        return redirect()->route('subcategories.index');
    }

    // Show form to edit an existing subcategory
    public function edit($SubCategoryID)
    {
        $subCategory = SubCategory::find($SubCategoryID);
        if (!$subCategory) {
            abort(404, 'SubCategory not found');
        }
        $categories = Category::all(); 
        return view('subcategories.edit', compact('subCategory', 'categories'));
    }

    // Update an existing subcategory
    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Name' => 'required|max:255|unique:sub_categories,Name,' . $subCategory->SubCategoryID . ',SubCategoryID',
            'Description' => 'required',
            'Status' => 'required|in:Active,Inactive',
        ]);
    
        $subCategory->update($request->all());
    
        session()->flash('success', 'SubCategory updated successfully!');
        return redirect()->route('subcategories.index');
    }

    // Delete a subcategory
    public function destroy(SubCategory $subCategory)
    {
        // Delete subcategory record
        $subCategory->delete();

        return response()->json(['success' => 'SubCategory deleted successfully!']);
    }
}