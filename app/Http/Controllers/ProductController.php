<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\NewSettler;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Mail\ProductCreated;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::with('category', 'sub_category', 'brand')->get();
        if ($request->ajax()) {
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('category_name', function ($products) {
                    return $products->category->title;
                })
                ->addColumn('sub_category_name', function ($products) {
                    return $products->sub_category->title;
                })
                ->addColumn('brand_name', function ($products) {
                    return $products->brand->title;
                })
                ->addColumn('action', function ($products) {
                    // Here you can add any action buttons or links
                    return '<button class="btn btn-primary mx-1 edit-btn" data-product=\'' . json_encode($products) . '\'>Edit</button>
                    <button class="btn btn-danger delete-btn" data-product=\'' . json_encode($products) . '\'>Delete</button>';
                })
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.products', compact('categories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $request->validate([
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        try {
            $product = new Product();
            $product->sku = $request['sku'];
            $product->price = $request['price'];
            $product->size_no = $request['size_no'];
            $product->new_collection = $request['new_collection'];
            $product->category_id = $request['category_id'];
            $product->sub_categories_id = $request['sub_categories_id'];
            $product->brands_id = $request['brands_id'];
            $product->description = $request['description'];
            $product->seasonability = $request['seasonability'];
            $product->quantity=$request['quantity'];
            $imageName = time() . '.' . $request->product_image->getClientOriginalExtension();
            $request->product_image->move(public_path('uploads'), $imageName);
            $product->product_image = $imageName;
            if ($product->save()) {
                $newSettlers = NewSettler::all();
                $product = [
                    'subject' => 'New Product Added: ' . $product->sku,
                    'body' => 'A new product has been added, please check it out.'
                ];
                // Send email to each NewSettler
                foreach ($newSettlers as $newSettler) {
                    Mail::to($newSettler->email)->send(new ProductCreated($product));
                }
                // Data saved successfully, return a success respons
                return response()->json(['status' => true, 'message' => 'Product saved successfully'], 200);
            } else {
                // Data saving failed, return an error response
                return response()->json(['status' => false, 'message' => 'Failed to save product'], 500);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function search($query)
    {

        $results = Product::where('sku', 'like', '%' . $query . '%')
            ->orWhere('price', 'like', '%' . $query . '%')
            ->get();
        $user_status = Auth::check() ? Auth::user() : null;
        return response()->json(['products' => $results, 'user_status' => $user_status]);
    }

    /**
     * Display the single product detail.
     */

    public function singleProduct($id)
    {
        $product = Product::with('category', 'sub_category', 'brand')->findOrFail($id);
        return view('single-product', compact('product'));
    }

    /**
     * Display the specified resource.
     */



    public function show(Request $request)
    {
        $categoriesProduct = Category::with('products')->get();
        if ($request->loadData) {
            $products = Product::all();
            $user_status = Auth::check() ? Auth::user() : null;
            return response()->json(['products' => $products, 'user_status' => $user_status]);
        }
        return view('index', compact('categoriesProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function sale()
    {
        $products = Product::where('sale', '1')->get();
        return view('sale', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->sku = $request['sku'];
        $product->price = $request['price'];
        $product->size_no = $request['size_no'];
        $product->new_collection = $request['new_collection'];
        $product->category_id = $request['category_id'];
        $product->sub_categories_id = $request['sub_categories_id'];
        $product->brands_id = $request['brands_id'];
        $product->description = $request['description'];
        $product->seasonability = $request['seasonability'];
        $product->quantity = $request['quantity'];
        $product->sale = $request['sale'];
        $product->discount = $request['discount'];
        if ($request->has('previuos_image')) {
            $product->product_image = $request['previuos_image'];
        } else {
            $request->validate([
                'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            ]);
            $imageName = time() . '.' . $request->product_image->getClientOriginalExtension();
            $request->product_image->move(public_path('uploads'), $imageName);
            $product->product_image = $imageName;
        }
        if ($product->update()) {
            return response()->json(['status' => true, 'message' => 'Product updated successfully'], 200);
        } else {
            // Data saving failed, return an error response
            return response()->json(['status' => false, 'message' => 'Failed to save product'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['status' => true, 'message' => 'Product deleted successfully'], 200);
    }
}
