<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $pageTitle = trans('panel.page_title.categories.add');
        $status = $this->status;
        return view('admin.categories.create', compact('pageTitle', 'status'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'description' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function show(Category $category)
    {
        $pageTitle = trans('panel.page_title.categories.show');
        $status = config('constant.enums.status');
        return view('admin.categories.show', compact('category', 'pageTitle', 'status'));
    }

    public function edit(Category $category)
    {
        $pageTitle = trans('panel.page_title.categories.edit');
        $status = $this->status;
        return view('admin.categories.edit', compact('category', 'pageTitle', 'status'));
    }

    public function update(UpdateRequest $request, Category $category)
    {
        $category->update($request->all());
        $notification = [
            'message' => trans('cruds.category.title_singular') . " " . trans('messages.edit_success_message'),
            'alert-type' => trans('panel.alert-type.success')
        ];
        return redirect()->route('admin.categories.index')->with($notification);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'success' => true,
            'message' => trans('cruds.category.title_singular') . ' ' . trans('messages.delete_success_message')
        ], 200);
    }

    public function changeStatus(Request $request)
    {
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
    
    }
}