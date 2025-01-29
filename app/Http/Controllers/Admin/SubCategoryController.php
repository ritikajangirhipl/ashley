<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; 

class SubCategoryController extends Controller
{
    private $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(SubCategoryDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.sub_category.list');
        return $dataTable->render('admin.sub-categories.index', compact('pageTitle'));

    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.sub_category.add');
            $status = $this->status;
            $categories = Category::where('status', 'active')->pluck('name', 'CategoryID'); 
            return view('admin.sub-categories.create', compact('pageTitle', 'status', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error in SubCategoryController@create: ' . $e->getMessage());
            return redirect()->route('admin.sub-categories.index')->with('error', 'An error occurred while preparing the create page.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:sub_categories,name|max:255', // Make sure 'sub_categories' is the correct table name
                'description' => 'required',
                'status' => 'required|in:active,inactive',
            ]);
    
            // Proceed to create the subcategory if validation passes
            SubCategory::create($validatedData);
    
            return response()->json([
                'success' => true,
                'message' => 'Subcategory created successfully!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Catch validation errors and return as JSON
            return response()->json([
                'success' => false,
                'errors' => $e->validator->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Log other errors and return a generic error message
            Log::error('Error in SubCategoryController@store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the subcategory.',
            ], 500);
        }
    }
    

    public function edit(SubCategory $subCategory)
    {
        try {
            $pageTitle = trans('panel.page_title.sub_category.edit');
            $status = $this->status;
            $categories = Category::where('status', 'active')->pluck('name', 'CategoryID'); 
            return view('admin.sub-categories.edit', compact('subCategory', 'pageTitle', 'status', 'categories'));
        } catch (\Exception $e) {
            Log::error('Error in SubCategoryController@edit: ' . $e->getMessage());
            return redirect()->route('admin.sub-categories.index')->with('error', 'An error occurred while preparing the edit page.');
        }
    }

    public function show(SubCategory $subCategory)
    {
        try {
            $pageTitle = trans('panel.page_title.sub_category.show');
            $status = config('constant.enums.status');
            return view('admin.sub-categories.show', compact('subCategory', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in SubCategoryController@show: ' . $e->getMessage());
            return redirect()->route('admin.sub-categories.index')->with('error', 'An error occurred while fetching the sub-category details.');
        }
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        try {
            $request->validate([
                'CategoryID' => 'required|exists:categories,CategoryID',
                'name' => 'required|unique:sub_categories,name,' . $subCategory->SubCategoryID . ',SubCategoryID',
                'description' => 'nullable',
                'status' => 'required|in:active,inactive',
            ], [
                'CategoryID.exists' => 'The selected category is invalid or does not exist.',
            ]);

            $category = Category::find($request->CategoryID);
            if (!$category || $category->status !== 'active') {
                return response()->json([
                    'success' => false,
                    'message' => 'The selected category has been deleted or is inactive.',
                ], 400);
            }

            $subCategory->update($request->all());

            return response()->json([
                'success' => true,
                'message' => trans('cruds.sub_category.title_singular') . " " . trans('messages.edit_success_message'),
            ]);
        } catch (\Exception $e) {
            Log::error('Error in SubCategoryController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the sub-category.',
            ], 500);
        }
    }

    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();
            return response()->json([
                'success' => true,
                'message' => trans('cruds.sub_category.title_singular') . ' ' . trans('messages.delete_success_message'),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in SubCategoryController@destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the sub-category.',
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            if ($request->ajax()) {
                $validator = Validator::make($request->all(), [
                    'id' => [
                        'required',
                        'numeric',
                        'exists:sub_categories,SubCategoryID',
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

                SubCategory::where('SubCategoryID', $request->id)->update(['status' => $request->status]);

                $response = [
                    'status' => 'true',
                    'message' => trans('cruds.sub_category.title_singular') . ' ' . trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        } catch (\Exception $e) {
            Log::error('Error in SubCategoryController@changeStatus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while changing the status.',
            ], 500);
        }
    }
}
