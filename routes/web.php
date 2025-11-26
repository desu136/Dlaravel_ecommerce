<?php

use App\Http\Controllers\UserController; 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController; 


Route::get('/',[UserController::class,'home'])->name('index');
Route::get('/productDetail/{id}',[UserController::class,'productDetails'])->name('product_details');
Route::get('/viewAllProducts',[UserController::class,'viewAllProducts'])->name('viewAllProducts');

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/addtocart/{id}', [UserController::class, 'addToCart'])->middleware(['auth', 'verified'])->name('addToCart');
Route::get('/cartproduct', [UserController::class, 'cartproduct'])->middleware(['auth', 'verified'])->name('viewcartproduct');
Route::get('/revomeCartProducts/{id}', [UserController::class, 'revome_cart_products'])->middleware(['auth', 'verified'])->name('removeCartProducts');
Route::post('/confirm_order', [UserController::class, 'confirmOrder'])->middleware(['auth', 'verified'])->name('confirm_orders');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addCategory');
Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postAddCategory');
Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewCategory');
Route::get('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deleteCategory');
Route::get('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updateCategory');
Route::post('/update_category/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postUpdateCategory');
Route::get('/veiwOrder', [AdminController::class, 'viewOrders'])->name('admin.viewOrders');

Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addProduct');
Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postAddProduct');
 Route::get('/view_product', [AdminController::class, 'viewProduct'])->name('admin.viewProduct');
Route::get('/Delete_product/{id}', [AdminController::class, 'delete_product'])->name('admin.deleteProduct');
Route::get('/update_product/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateProduct');
Route::post('/update_product/{id}', [AdminController::class, 'postUpdateProduct'])->name('admin.postUpdateProduct');
Route::post('/search', [AdminController::class, 'searchProduct'])->name('admin.searchProduct');
});


require __DIR__.'/auth.php';
