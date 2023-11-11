<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoiesController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Categories;

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

Route::get('/',[UserController::class, 'index']);
Route::get('/login',[UserController::class, 'login']);
Route::post('/login',[UserController::class, 'authenticate']);
Route::get('/register',[UserController::class, 'register']);
Route::post('/register',[UserController::class, 'storeUser']);
Route::get('/logout',[UserController::class, 'logout']);
Route::middleware(['admin.check'])->group(function () {
    Route::get('/admin',[UserController::class, 'isAdmin']);
    Route::get('/addCategory',[CategoiesController::class, 'addCategory']);
    Route::post('/addCategory',[CategoiesController::class, 'storeCategory']);
    Route::get('/edit-category/{category_id}',[CategoiesController::class,'editCategory'])->name('edit.category');
    Route::post('/edit-category/{category_id}',[CategoiesController::class,'updateCategory'])->name('update.category');
    Route::get('/delete-category/{category_id}',[CategoiesController::class,'deleteCategory'])->name('delete.category');
    Route::get('/restore-category/{category_id}',[CategoiesController::class,'restoreCategory'])->name('restore.category');
    Route::get('/force-delete-category/{category_id}',[CategoiesController::class,'forceDeleteCategory'])->name('force.delete.category');
    Route::get('/view-trash-category',[CategoiesController::class, 'viewTrash'])->name('view.trash.category');
    Route::get('/addProduct',[ProductController::class, 'addProduct']);
    Route::post('/addProduct',[ProductController::class, 'storeProduct']);
    Route::get('/edit-product/{product_id}',[ProductController::class,'editProduct'])->name('edit.product');
    Route::post('/edit-product/{product_id}',[ProductController::class,'updateProduct'])->name('update.product');
    Route::get('/delete-product/{product_id}',[ProductController::class,'deleteProduct'])->name('delete.product');
    Route::get('/restore-product/{product_id}',[ProductController::class,'restoreProduct'])->name('restore.product');
    Route::get('/force-delete-product/{product_id}',[ProductController::class,'forceDeleteProduct'])->name('force.delete');
    Route::get('/view-trash',[ProductController::class, 'viewTrash'])->name('view.trash');

});
Route::get('/view-products',[ProductController::class, 'showProduct']);
Route::get('/view-products/{category_id}',[ProductController::class, 'showProductByCategory'])->name('products.category');

Route::get('/view-categories',[CategoiesController::class, 'showCategories']);
Route::get('/cart',[CartController::class, 'index']);
Route::post('/update-cart/{cart_id}',[CartController::class,'updateCart'])->name('cart.update');
Route::post('/add-to-cart',[CartController::class, 'addToCart'])->name('add.cart');
Route::get('/delete-cart-item/{cart_id}',[CartController::class,'deleteCartItem'])->name('cart.item.delete');
Route::get('/checkout',[OrderItemController::class, 'checkoutItems'])->name('checkout.items');
Route::post('/place-order',[OrderItemController::class, 'placeOrder'])->name('place.order');


