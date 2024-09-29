<?php

use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

if (!function_exists('categoriesData')) {
    function categoriesData()
    {
        $categories = Category::with('sub_categories')
            ->where('active_status', '1') // Only get categories with status 1
            ->get();
        return $categories;
    }
}

if (!function_exists('brandsData')) {
    function brandsData()
    {
        $brands = Brand::all();
        return $brands;
    }
}

if (!function_exists('cartData')) {
    function cartData()
    {
        if (Auth::user()) {
            $totalCarts = Cart::where('user_id', Auth::user()->id)->count();
            return $totalCarts;
        }
    }
}
