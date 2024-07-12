<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->ajax()) {

            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function ($category) {
                    // Here you can add any action buttons or links
                    return '<button class="btn btn-primary mx-1 edit-btn" data-category=\'' . json_encode($category) . '\'>Edit</button><button class="btn btn-danger delete-btn" data-category=\'' . json_encode($category) . '\'>Delete</button>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.categories');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = new Category();
        $category->title = $request['title'];
        $category->active_status = $request['activeStatus'];
        if ($category->save()) {
            // Data saved successfully, return a success response

            return response()->json(['status' => true, 'message' => 'Category saved successfully'], 200);
        } else {
            // Data saving failed, return an error response
            return response()->json(['status' => false, 'message' => 'Failed to save Category'], 500);
        }
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the category by its ID
        $category = Category::findOrFail($id);

        // Update the category attributes
        $category->update($request->only('title', 'active_status', 'category_id'));
        // Return a response indicating success
        return response()->json(['status' => true, 'message' => 'Category updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['status' => true, 'message' => 'Category deleted successfully'], 200);
    }
}
