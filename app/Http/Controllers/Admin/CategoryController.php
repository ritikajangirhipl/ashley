<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; 

class CategoryController extends Controller
{
    private $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(CategoryDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.categories.list');
        return $dataTable->render('admin.categories.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.categories.add');
            $status = $this->status;
            return view('admin.categories.create', compact('pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in CategoryController@create: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'An error occurred while preparing the create page.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:categories|max:255',
                'description' => 'required',
                'status' => 'required|in:active,inactive',
            ]);

            Category::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Category created successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in CategoryController@store: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the category.',
            ], 500);
        }
    }

    public function show(Category $category)
    {
        try {
            $pageTitle = trans('panel.page_title.categories.show');
            $status = config('constant.enums.status');
            return view('admin.categories.show', compact('category', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in CategoryController@show: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'An error occurred while fetching the category details.');
        }
    }

    public function edit(Category $category)
    {
        try {
            $pageTitle = trans('panel.page_title.categories.edit');
            $status = $this->status;
            return view('admin.categories.edit', compact('category', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            Log::error('Error in CategoryController@edit: ' . $e->getMessage());
            return redirect()->route('admin.categories.index')->with('error', 'An error occurred while preparing the edit page.');
        }
    }

    public function update(UpdateRequest $request, Category $category)
    {
        try {
            $category->update($request->except('_token', '_method'));

            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Error in CategoryController@update: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating the category.',
            ], 500);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => trans('cruds.category.title_singular') . ' ' . trans('messages.delete_success_message'),
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error in CategoryController@destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the category.',
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
                        'exists:categories,CategoryID',
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

                $category = Category::where('CategoryID', $request->id)->update(['status' => $request->status]);

                $response = [
                    'status' => 'true',
                    'message' => trans('cruds.category.title_singular') . ' ' . trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        } catch (\Exception $e) {
            Log::error('Error in CategoryController@changeStatus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while changing the status.',
            ], 500);
        }
    }
}
