<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\StoreRequest;
use App\Http\Requests\SubCategory\UpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    protected $status;

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
            $categories = Category::where('status', 'active')->pluck('name', 'id');
            return view('admin.sub-categories.create', compact('pageTitle', 'status', 'categories'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            SubCategory::create($request->all());
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.sub_category')]),
            ['redirect_url' => route('admin.sub-categories.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(SubCategory $subCategory)
    {
        try {
            $pageTitle = trans('panel.page_title.sub_category.show');
            $status = $this->status;
            return view('admin.sub-categories.show', compact('subCategory', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(SubCategory $subCategory)
    {
        try {
            $pageTitle = trans('panel.page_title.sub_category.edit');
            $status = $this->status;
            $categories = Category::where('status', 'active')->pluck('name', 'id');
            return view('admin.sub-categories.edit', compact('subCategory', 'pageTitle', 'status', 'categories'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, SubCategory $subCategory)
    {
        try {
            $subCategory->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.sub_category')]),
            ['redirect_url' => route('admin.sub-categories.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(SubCategory $subCategory)
    {
        try {
            $subCategory->delete();
            return jsonResponseWithMessage(200, 'Sub Category deleted successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}
