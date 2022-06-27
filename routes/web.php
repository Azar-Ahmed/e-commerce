<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\ColorController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\front\FrontController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Front Ends 
    Route::get('/', [FrontController::class, 'Index']);
    Route::get('shop/{slug}', [FrontController::class, 'ShopPage']);    
    Route::get('product/{slug}', [FrontController::class, 'ProductDetail']);
    Route::post('add-to-cart', [FrontController::class, 'AddToCart'])->name('add-to-cart');
    Route::post('fetch-cart-data', [FrontController::class, 'FetchCartData'])->name('fetch-cart-data');
    Route::get('cart/{user_id}', [FrontController::class, 'CartPage']);
    Route::get('cart-remove/{id}', [FrontController::class, 'CartRemove']);    
    Route::post('search', [FrontController::class, 'Search'])->name('search');

// Admin Login
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/admin/auth', [AdminController::class, 'auth'])->name('admin.auth');
    Route::get('/admin/update-password', [AdminController::class, 'UpdatePassword']);

Route::group(['middleware' => 'admin_auth'], function () {
   
    // Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);

    // Category
    Route::get('admin/category', [CategoryController::class, 'Category']);
    Route::get('admin/category-form/{slug}', [CategoryController::class, 'CategoryForm']);
    Route::post('category/save', [CategoryController::class, 'CategoryManage'])->name('category.save');
    Route::get('category-delete/{id}', [CategoryController::class, 'CategoryDelete']);
    Route::get('category-status/{status}/{cat_slug}', [CategoryController::class, 'CategoryStatus']);

    // Coupon
    Route::get('admin/coupon', [CouponController::class, 'coupon']);
    Route::get('admin/coupon-form/{id}', [CouponController::class, 'CouponForm']);
    Route::post('coupon/save', [CouponController::class, 'CouponManage'])->name('coupon.save');
    Route::get('coupon-delete/{id}', [CouponController::class, 'CouponDelete']);
    Route::get('coupon-status/{status}/{id}', [CouponController::class, 'CouponStatus']);

    // Brand
    Route::get('admin/brand', [BrandController::class, 'brand']);
    Route::get('admin/brand-form/{id}', [BrandController::class, 'brandForm']);
    Route::post('brand/save', [BrandController::class, 'brandManage'])->name('brand.save');
    Route::get('brand-delete/{id}', [BrandController::class, 'brandDelete']);
    Route::get('brand-status/{status}/{id}', [BrandController::class, 'brandStatus']);

    // Banner
    Route::get('admin/banner', [BannerController::class, 'banner']);
    Route::get('admin/banner-form/{id}', [BannerController::class, 'bannerForm']);
    Route::post('banner/save', [BannerController::class, 'bannerManage'])->name('banner.save');
    Route::get('banner-delete/{id}', [BannerController::class, 'bannerDelete']);
    Route::get('banner-status/{status}/{id}', [BannerController::class, 'bannerStatus']);

    // Product
    Route::get('admin/product', [ProductController::class, 'product']);
    Route::get('product-view/{id}', [ProductController::class, 'ProductView']);
    Route::get('admin/product-form/{id}', [ProductController::class, 'ProductForm']);
    Route::post('product/save', [ProductController::class, 'ProductManage'])->name('product.save');
    Route::get('product-delete/{id}', [ProductController::class, 'ProductDelete']);
    Route::get('product-status/{status}/{id}', [ProductController::class, 'ProductStatus']);
    
    // Product Attributes
    Route::post('product-attr-save', [ProductController::class, 'ProductAttributesStore'])->name('product-attr-save');
    Route::post('product-attr-fetch', [ProductController::class, 'ProductAttributesFetch'])->name('product-attr-fetch');

    // Size
    Route::get('admin/size', [SizeController::class, 'size']);
    Route::get('admin/size-form/{id}', [SizeController::class, 'sizeForm']);
    Route::post('size/save', [SizeController::class, 'sizeManage'])->name('size.save');
    Route::get('size-delete/{id}', [SizeController::class, 'sizeDelete']);
    Route::get('size-status/{status}/{id}', [SizeController::class, 'sizeStatus']);

    // Color
    Route::get('admin/color', [ColorController::class, 'color']);
    Route::get('admin/color-form/{id}', [ColorController::class, 'ColorForm']);
    Route::post('color/save', [ColorController::class, 'ColorManage'])->name('color.save');
    Route::get('color-delete/{id}', [ColorController::class, 'ColorDelete']);
    Route::get('color-status/{status}/{id}', [ColorController::class, 'ColorStatus']);

    // Users
    Route::get('admin/user', [UserController::class, 'user']);
    Route::get('user-status/{status}/{id}', [UserController::class, 'UserStatus']);

    // Logout
    Route::get('admin/logout', function () {
        session()->forget('AdminLogin');
        session()->forget('AdminID');
        return redirect('/admin')->with('error', 'Logout sucessfully done');
    });
});
