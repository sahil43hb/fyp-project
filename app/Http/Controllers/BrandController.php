<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $brands = Brand::all();
        if ($request->ajax()) {

            return DataTables::of($brands)
                ->addIndexColumn()
                ->addColumn('action', function ($brands) {
                    return '<button class="btn bg-color text-white mx-1 edit-btn" data-brand=\'' . json_encode($brands) . '\'>Edit</button><button class="btn btn-danger delete-btn" data-brand=\'' . json_encode($brands) . '\'>Delete</button>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.brands');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $brand = new Brand();
        $brand->title = $request['title'];
        $brand->active_status = $request['activeStatus'];
        if ($brand->save()) {
            // Data saved successfully, return a success response

            return response()->json(['status' => true, 'message' => 'Brand saved successfully'], 200);
        } else {
            // Data saving failed, return an error response
            return response()->json(['status' => false, 'message' => 'Failed to save Brand'], 500);
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
    public function show($id)
    {
        $brandsWithProducts = Brand::with('products')->findOrFail($id);
        // dd($brandsWithProducts);
        return view('brand', compact('brandsWithProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the category by its ID
        $brand = Brand::findOrFail($id);

        // Update the category attributes
        $brand->update($request->only('title', 'active_status', 'category_id'));
        // Return a response indicating success
        return response()->json(['status' => true, 'message' => 'Brand updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return response()->json(['status' => true, 'message' => 'Brand deleted successfully'], 200);
    }
}
