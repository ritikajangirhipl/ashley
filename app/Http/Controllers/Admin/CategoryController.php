<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\ProviderType;
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

    // public function store(StoreRequest $request)
    // {
    //     try {
    //         Category::create($request->all());
    //         return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.category')]), 
    //         ['redirect_url' => route('admin.categories.index')]); 
    //     } catch (\Exception $e) {
    //         return jsonResponseWithException($e);
    //     }
    // }

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

            return redirect()->route('admin.categories.index')->with('success', 'Category added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
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

    // public function update(UpdateRequest $request, Category $category)
    // {
    //     try {
    //         if ($request->status == 0 && $category->subCategories()->count() > 0) {
    //             return response()->json([
    //                 'status' => 400,
    //                 'message' => __('messages.category_associated_with_subcategories', ['attribute' => __('attribute.category')])
    //             ], 400);
    //         }

    //         $category->update($request->except('_token', '_method'));
    
    //         return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.category')]),
    //         ['redirect_url' => route('admin.categories.index')]);
    //     } catch (\Exception $e) {
    //         return jsonResponseWithException($e);
    //     }
    // }
    
    public function update(UpdateRequest $request, Category $category)
    {
        try {
            if ($request->status == 0 && $category->subCategories()->count() > 0) {
                return redirect()->back()->with('error', __('messages.category_associated_with_subcategories', ['attribute' => __('attribute.category')]));
            }

            $imagePath = $this->uploadImage($request, $category);

            $category->update([
                'name' => $request->name,
                'image' => $imagePath,
                'description' => $request->description,
                'status' => $request->status,
            ]);

            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    
    public function destroy(Category $category)
    {
        try {
            if ($category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }
            $category->delete();

            return response()->json([
                'status' => true,
                'message' => __('messages.delete_success_message', ['attribute' => __('attribute.category')])
            ], 200);
        } catch (\Exception $e) {
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
            $imagePath = $file->storeAs('public/categories', $filename);
            $imagePath = str_replace('public/', '', $imagePath);
        }

        return $imagePath;
    }
}





