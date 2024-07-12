<?php

use App\Http\Controllers\Admin\AuthenticationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Route::group(['middleware' => 'guest'], function () {
// Place your authenticated routes here
Route::get('/admin-panel/login', [AuthenticationController::class, 'index']);
Route::post('/admin-panel/login', [AuthenticationController::class, 'Authenticate']);
// Add more authenticated routes as needed
// });

Route::prefix('admin-panel')->middleware(['admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/generate_report', [DashboardController::class, 'generateReport'])->name('report_generate');
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin_profile');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name(('admin_change_password'));
    
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'create']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
    Route::get('/sub_categories', [SubCategoryController::class, 'index']);
    Route::post('/sub_categories', [SubCategoryController::class, 'create']);
    Route::put('/sub_categories/{id}', [SubCategoryController::class, 'update']);
    Route::delete('/sub_categories/{id}', [SubCategoryController::class, 'destroy']);
    Route::get('/sub_categories/{id}', [SubCategoryController::class, 'subcategoriesOfCategories']);
    Route::get('/brands', [BrandController::class, 'index']);
    Route::post('/brands', [BrandController::class, 'create']);
    Route::put('/brands/{id}', [BrandController::class, 'update']);
    Route::delete('/brands/{id}', [BrandController::class, 'destroy']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'create']);
    Route::post('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name(('admin_login'));
});
