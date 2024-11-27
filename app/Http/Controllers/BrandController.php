<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:brands',
        ]);
    
        if ($validator->fails()) {
            // Return the first error message for better user feedback
            return response()->json([
                "status" => false,
                "message" => $validator->errors()->first() // Get the first error message
            ], 422);
        }
    
        $brand = new Brand();
        $brand->title = $request->input('title');
        $brand->active_status = $request->input('activeStatus');
    
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
        // Find the brand by its ID
        $brand = Brand::findOrFail($id);
        // Update the brand attributes
        $brand->update($request->only('title', 'active_status'));
        // Return a response indicating success
        return response()->json(['status' => true, 'message' => 'Brand updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    $brand = Brand::findOrFail($id);
    // Check if the brand has related products
    if (Product::where('brands_id', $id)->exists()) {
        return response()->json(['status' => false, 'message' => 'Cannot delete brand with associated products.'], 400);
    }
    $brand->delete();
    return response()->json(['status' => true, 'message' => 'Brand deleted successfully'], 200);
    }

}
