<?php
namespace App\Http\Controllers\Admin;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\StoreRequest;
use App\Http\Requests\SubCategory\UpdateRequest;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

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
            $categories = getActiveCategories(); 
            return view('admin.sub-categories.create', compact('pageTitle', 'status', 'categories'));
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $category = Category::where('id', $request->category_id)->where('status', 1)->first();

            if (!$category) {
                return response()->json([
                    'status' => 400,
                    'message' => __('messages.category_not_found')
                ], 400);
            }

            $imagePath = $this->uploadImage($request);

            SubCategory::create([
                'name' => $request->name,
                'image' => $imagePath,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);

            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.sub_category')]), 
                ['redirect_url' => route('admin.sub-categories.index')]);

        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show($id)
    {
        try {
            $subCategory = SubCategory::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.sub_category.show');
            $status = $this->status;
            return view('admin.sub-categories.show', compact('subCategory', 'pageTitle'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit($id)
    {
        try {
            $subCategory = SubCategory::where('id', decrypt($id))->firstOrFail();
            $pageTitle = trans('panel.page_title.sub_category.edit');
            $status = $this->status;
            $categories = getActiveCategories(); 
            return view('admin.sub-categories.edit', compact('subCategory', 'pageTitle', 'status', 'categories'));
        } catch (ModelNotFoundException) {
            abort(404);
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, SubCategory $subCategory)
    {
        try {
            $category = Category::find($request->category_id);
            if (!$category) {
                return jsonResponseWithMessage(400, __('messages.category_not_found'), []);
            }
            if ($request->status == '0' && $subCategory->services()->exists()) {
                return response()->json([
                    'status' => 400,
                    'message' => __('messages.sub_category_associated_with_services', ['attribute' => __('attribute.sub_category')])
                ], 400);
            }
            
            $imagePath = $this->uploadImage($request, $subCategory);

            $subCategory->update([
                'name' => $request->name,
                'image' => $imagePath,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'status' => $request->status,
            ]);

            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.sub_category')]), 
                ['redirect_url' => route('admin.sub-categories.index')]);

        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy($id)
    {
        try {
            $subCategory = SubCategory::find($id);

            if (!$subCategory) {
                return response()->json([
                    'status' => false,
                    'message' => __('messages.sub_category_already_deleted') 
                ], 400); 
            }

            if ($subCategory->services()->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => __('messages.sub_category__delete_error', ['attribute' => __('attribute.sub_category')]) 
                ], 400);
            }
    
            if ($subCategory->image && Storage::exists('public/' . $subCategory->image)) {
                Storage::delete('public/' . $subCategory->image);
            }
    
            $subCategory->delete();
    
            return response()->json([
                'status' => true,
                'message' => __('messages.delete_success_message', ['attribute' => __('attribute.sub_category')])
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => __('messages.unexpected_error')
            ], 500);
        }
    }
    

    private function uploadImage(Request $request, SubCategory $subCategory = null)
    {
        $imagePath = $subCategory ? $subCategory->image : null; 

        if ($request->hasFile('image')) {
            if ($subCategory && $subCategory->image && Storage::exists('public/' . $subCategory->image)) {
                Storage::delete('public/' . $subCategory->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $imagePath = $file->storeAs('public/subcategory_images', $filename);

            $imagePath = str_replace('public/', '', $imagePath);
        }

        return $imagePath;
    }


    public function getSubCategories(Request $request)
    {
        $subCategories = getActiveSubCategories($request->category_id);
        if($subCategories){

            return response()->json([
                'status' => 400,
                'message' => __('attribute.sub_category'),
                'sub_categories' => $subCategories,
            ], 200);
        }else{
            return response()->json([
                'status' => 400,
                'message' => __('messages.record_not_found',['record' => __('attribute.country')])
            ], 400);
        }

    }
}

