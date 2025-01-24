<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\DataTables\SubCategoryDataTable;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryController extends Controller
{
    private $status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(SubCategoryDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.sub_categories.list');
        return $dataTable->render('admin.sub-categories.index', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = trans('panel.page_title.sub_categories.add');
        $status = $this->status;
        $categories = Category::pluck('name', 'CategoryID');
        return view('admin.sub-categories.create', compact('pageTitle', 'status', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'CategoryID' => 'required|exists:categories,CategoryID',
            'name' => 'required|unique:sub_categories|max:255',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);

        SubCategory::create($request->all());

        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category created successfully!');
    }

    public function edit(SubCategory $subCategory)
    {
        $pageTitle = trans('panel.page_title.sub_categories.edit');
        $status = $this->status;
        $categories = Category::pluck('name', 'CategoryID'); 
        return view('admin.sub-categories.edit', compact('subCategory', 'pageTitle', 'status', 'categories'));
    }

    public function show(SubCategory $subCategory)
    {
        $pageTitle = trans('panel.page_title.sub_categories.show');
        $status = config('constant.enums.status');
        return view('admin.sub-categories.show', compact('subCategory', 'pageTitle', 'status'));
    }

    public function update(Request $request, SubCategory $subCategory)
    {
        $request->validate([
            'CategoryID' => 'required|exists:categories,CategoryID',
            'name' => 'required|unique:sub_categories,name,' . $subCategory->SubCategoryID . ',SubCategoryID',
            'description' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);

        $subCategory->update($request->all());

        return redirect()->route('admin.sub-categories.index')->with('success', 'Sub Category updated successfully!');
    }

    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return response()->json([
            'success' => true,
            'message' => trans('cruds.sub_category.title_singular') . ' ' . trans('messages.delete_success_message'),
        ], 200);
    }

    public function changeStatus(Request $request)
    {
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

            $subCategory = SubCategory::where('SubCategoryID', $request->id)->update(['status' => $request->status]);

            $response = [
                'status' => 'true',
                'message' => trans('cruds.sub_category.title_singular') . ' ' . trans('messages.change_status_success_message'),
            ];
            return response()->json($response);
        }
    }
}