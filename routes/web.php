<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CompleteController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\OrderEmailController;
use App\Http\Controllers\AddressController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProviderAdmin and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('index');
//});
Route::get('/compare', [ProductController::class, 'showCompare']);
Route::post('/compare/product/add/{id}', [ProductController::class, 'storeCompare'])->name('compare.add');
Route::post('/compare/product/delete/{id}', [ProductController::class, 'deleteCompare'])->name('compare.delete');

Route::get('/orders', [OrderController::class, 'showOrder'])->name('orders');
Route::get('/order-details/product/{orderId}', [OrderController::class, 'showOrderDetail'])->name('order.detail');

Route::post('canceled/order/{orderId}', [OrderController::class, 'canceledOrder'])->name('canceled.order');
Route::get('/api/check-order-status', [\App\Http\Controllers\OrderController::class, 'checkOrderStatus']);

//Route::get('/deletes', [UserController::class, 'deletes']);

Route::get('/header', function () {
    return view('layouts.header');
});

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/products/{id}', [ProductController::class, 'find'])->name('productDetail');

//Route::get('/carts', [CartController::class, 'index'])->name('cart')->middleware('auth');
//Route::post('/carts', [CartController::class, 'store']);

Route::post('/cart/add/{id}',  [CartController::class, 'add'])->name('add');
Route::get('/cart', [CartController::class, 'index']);

Route::get('/carts/delete/{rowId}', [CartController::class, 'delete'])->name('remove');
Route::post('/carts/update',  [CartController::class, 'update'])->name('update');

Route::get('/checkout', [OrderController::class, 'index']);
Route::post('/checkout',  [OrderController::class, 'store']);

Route::get('/completes', [CompleteController::class, 'index'])->name('complete');
Route::post('/completes', [CompleteController::class, 'store']);

Route::get('/address', [AddressController::class, 'index'])->name('address');
Route::post('/address', [AddressController::class, 'store']);
Route::get('/address/delete/{id}', [AddressController::class, 'delete'])->name('delete.address');

Route::prefix('admin')->middleware(['CheckRole:CUSTOMER', 'AuthAdmin'])->group(function () {
    Route::prefix('/edit')->group(function () {
        Route::get('/user/{name}', [UserController::class, 'index_edit']);
        Route::post('/user/{name}', [UserController::class, 'edit'])->name('edit.user');
        Route::get('/product/{name}', [\App\Http\Controllers\Admin\ProductController::class, 'index_edit']);
        Route::post('/product/{name}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('edit.product');
        Route::post('/status/{orderId}', [\App\Http\Controllers\Admin\OrderController::class, 'edit'])->name('edit.status');
    });
    Route::prefix('/delete')->group(function () {
        Route::get('/user/{name}', [UserController::class, 'index_delete']);
        Route::post('/user/{name}', [UserController::class, 'delete'])->name('delete.user');
        Route::get('/product/{name}', [\App\Http\Controllers\Admin\ProductController::class, 'delete'])->name('delete.product');
        Route::get('/order/{orderId}', [\App\Http\Controllers\Admin\OrderController::class, 'delete'])->name('delete.order');
    });
    Route::prefix('/list')->group(function () {
        Route::get('/product', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('list.product');
        Route::get('/user', [UserController::class, 'index'])->name('list.user');
        Route::get('/post', function () {
            return view('admin.list.post');
        })->name('list.post');
        Route::get('/order', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('list.order');
        Route::get('/order-detail/{orderId}', [\App\Http\Controllers\Admin\OrderDetailController::class, 'index'])->name('list.orderDetail');

    });
    Route::prefix('/add')->group(function () {
        Route::get('/product', function () {
            return view('admin.add.product');
        });
        Route::post('/product', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('add.product');
        Route::get('/post', function () {
            return view('admin.add.post');
        })->name('add.post');
        Route::get('/user', function () {
            return view('admin.add.user');
        });
        Route::post('/user', [UserController::class, 'add'])->name('add.user');
    });

    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/cat', function () {
        return view('admin.cat');
    })->name('admin.cat');

    Route::get('/catProduct', function () {
        return view('admin.catProduct');
    })->name('admin.catProduct');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

