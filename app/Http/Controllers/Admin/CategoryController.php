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
            if ($request->status == '0' && $category->subCategories()->exists()) {
                return response()->json([
                    'status' => 400,
                    'message' => __('messages.category_associated_with_subcategories', ['attribute' => __('attribute.category')])
                ], 400);
            }
    
            $imagePath = $category->image;

            if ($request->hasFile('image')) {
                if ($category->image && Storage::exists('public/' . $category->image)) {
                    Storage::delete('public/' . $category->image);
                }
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $imagePath = $file->storeAs('public/category_images', $filename);
                $imagePath = str_replace('public/', '', $imagePath);
            }

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
            // Check if the category has related subcategories
            if ($category->subCategories()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => __('messages.category_delete_error', ['attribute' => __('attribute.category')])
                ], 400);
            }

            // Delete the category image if it exists
            if ($category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }

            // Delete the category
            $category->delete();

            return response()->json([
                'status' => true,
                'message' => __('messages.delete_success_message', ['attribute' => __('attribute.category')])
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('messages.unexpected_error')
            ], 500);
        }
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





