<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

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
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $imagePath = $this->uploadImage($request);

            Category::create([
                'name' => $request->name,
                'image' => $imagePath,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.category')]),
            ['redirect_url' => route('admin.categories.index')]);

        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }


    public function show($id)
    {
        try {
            $category = Category::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.category.show');
            $status = $this->status;
            return view('admin.categories.show', compact('category', 'pageTitle'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $category = Category::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.category.edit');
            $status = $this->status;
            return view('admin.categories.edit', compact('category', 'pageTitle', 'status'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Category $category)
    {
        try {
            if ($request->status == '0') {
                $existenceCheck = $this->checkExistance($category, true);
                if ($existenceCheck) {
                    return $existenceCheck;
                }
            }
            $imagePath = $this->uploadImage($request, $category);

            $category->update([
                'name' => $request->name,
                'image' => $imagePath,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.category')]), 
            ['redirect_url' => route('admin.categories.index')]);

        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }


    public function destroy(Category $category)
    {
        try {

            $existenceCheck = $this->checkExistance($category);
            if ($existenceCheck) {
                return $existenceCheck; 
            }

            if ($category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }

            $category->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.category')]),
            ['redirect_url' => route('admin.categories.index')]);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    private function checkExistance($category, $forStatusUpdate = false)
    {
        if ($category->services()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => $forStatusUpdate
                    ? __('messages.category_associated_with_services') 
                    : __('messages.category_service_delete_error') 
            ], 400);
        }

        if ($category->subCategories()->exists()) {
            return response()->json([
                'status' => 400,
                'message' => $forStatusUpdate
                    ? __('messages.category_associated_with_subcategories') 
                    : __('messages.category_delete_error') 
            ], 400);
        }
        return null;
    }

    private function uploadImage(Request $request, Category $category = null)
    {
        $imagePath = $category ? $category->image : null; 

        if ($request->hasFile('image')) {
            if ($category && $category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('public/category_images', $filename);

            $imagePath = str_replace('public/', '', $imagePath);
        }

        return $imagePath;
    }

    
}





