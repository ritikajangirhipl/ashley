<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(CategoryDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.category.list');
        return $dataTable->render('admin.categories.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.category.add');
            $status = $this->status;
            return view('admin.categories.create', compact('pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e); 
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            Category::create($request->all());
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.category')]), 
            ['redirect_url' => route('admin.categories.index')]); 
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(Category $category)
    {
        try {
            $pageTitle = trans('panel.page_title.category.show');
            return view('admin.categories.show', compact('category', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(Category $category)
    {
        try {
            $pageTitle = trans('panel.page_title.category.edit');
            $status = $this->status;
            return view('admin.categories.edit', compact('category', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e); 
        }
    }

    public function update(UpdateRequest $request, Category $category)
    {
        try {
            if ($request->status == '1' && $category->subCategories()->count() > 0) {
                return response()->json([
                    'status' => 400,
                    'message' => __('messages.category_associated_with_subcategories', ['attribute' => __('attribute.category')])
                ], 400);
            }
    
            $category->update($request->except('_token', '_method'));
    
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.category')]),
            ['redirect_url' => route('admin.categories.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Category $category)
    {
        try {
            if ($category->subCategories()->count() > 0) {
                return response()->json([
                    'status' => 400,
                    'message' => __('messages.category_associated_with_subcategories', ['attribute' => __('attribute.category')])
                ], 400);
            }

            $category->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.category')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}





