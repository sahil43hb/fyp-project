<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $sub_categories = SubCategory::with('category')->get();
        if ($request->ajax()) {
            return DataTables::of($sub_categories)
                ->addIndexColumn()
                ->addColumn('category_name', function ($sub_category) {
                    return $sub_category->category->title;
                })
                ->addColumn('action', function ($sub_categories) {
                    // Here you can add any action buttons or links
                    return '<button class="btn bg-color text-white mx-1 edit-btn" data-sub_category=\'' . json_encode($sub_categories) . '\'>Edit</button><button class="btn btn-danger delete-btn" data-sub_category=\'' . json_encode($sub_categories) . '\'>Delete</button>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.subcategory', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $sub_category = new SubCategory();
        $sub_category->title = $request['title'];
        $sub_category->active_status = $request['activeStatus'];
        $sub_category->category_id = $request['category_id'];
        if ($sub_category->save()) {
            return response()->json(['status' => true, 'message' => 'Sub Category saved successfully'], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Failed to save Sub Category'], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function subcategoriesOfCategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $subCategoriesWithProducts = SubCategory::with('products')->findOrFail($id);
        // dd($brandsWithProducts);
        return view('sub_categories', compact('subCategoriesWithProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, $id)
    {
        $sub_category = SubCategory::findOrFail($id);
        // Update the category attributes
        $sub_category->update($request->only('title', 'active_status', 'category_id'));
        // Return a response indicating success
        return response()->json(['status' => true, 'message' => 'Sub Category updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $sub_category->delete();

        return response()->json(['status' => true, 'message' => 'Sub Category deleted successfully'], 200);
    }
}
