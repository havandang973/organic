<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CompleteController;
use \App\Http\Controllers\OrderEmailController;
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

//Route::get('/', function () {
//    return view('index');
//});

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/products/{id}', [ProductController::class, 'find'])->name('productDetail');

//Route::get('/carts', [CartController::class, 'index'])->name('cart')->middleware('auth');
//Route::post('/carts', [CartController::class, 'store']);

Route::get('/cart/add/{id}',  [CartController::class, 'add'])->name('add');
Route::get('/cart', function () {
    return view('cart');
});

Route::get('/carts/delete/{rowId}', [CartController::class, 'delete'])->name('remove');
Route::post('/carts/update',  [CartController::class, 'update'])->name('update');

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders',  [OrderController::class, 'store']);

Route::get('/completes', [CompleteController::class, 'index'])->name('complete');
Route::post('/completes', [CompleteController::class, 'store']);

Route::prefix('admin')->group(function () {
    Route::prefix('/list')->group(function () {
        Route::get('/product', function () {
            return view('admin.list.product');
        })->name('list.product');
        Route::get('/user', function () {
            return view('admin.list.user');
        })->name('list.user');
        Route::get('/post', function () {
            return view('admin.list.post');
        })->name('list.post');
        Route::get('/order', function () {
            return view('admin.list.order');
        })->name('list.order');
    });
    Route::prefix('/add')->group(function () {
        Route::get('/product', function () {
            return view('admin.add.product');
        })->name('add.product');
        Route::get('/post', function () {
            return view('admin.add.post');
        })->name('add.post');
        Route::get('/user', function () {
            return view('admin.add.user');
        })->name('add.user');
    });
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

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

