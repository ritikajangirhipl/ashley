<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Requests\Category\StatusRequest;
use App\Models\Category;
use App\Helpers\Helper;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    protected $status;

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
            return jsonResponseWithException($e); 
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            Category::create($request->all());
            $status = $this->status;
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.category')])); 
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(Category $category)
    {
        try {
            $pageTitle = trans('panel.page_title.categories.show');
            $status = $this->status;
            return view('admin.categories.show', compact('category', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(Category $category)
    {
        try {
            $pageTitle = trans('panel.page_title.categories.edit');
            $status = $this->status;
            return view('admin.categories.edit', compact('category', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e); 
        }
    }

    public function update(UpdateRequest $request, Category $category)
    {
        try {
            $category->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.category')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return jsonResponseWithMessage(200, 'Category deleted successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function changeStatus(StatusRequest $request)
    {
        try {
            $status = $request->status == 1 ? 'active' : 'inactive';
    
            $category = Category::where('id', $request->id)->update(['status' => $status]);
            return jsonResponseWithMessage(200, 'Category status updated successfully!');
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    
}





