<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('home');
});
Route::get('/ych-comission', function () {
    return view('ych-comission');
});
Route::get('/member', function () {
    return view('member');
});
Route::get('/member/register', function () {
    return view('member-register');
});




Route::group(['middleware' => 'role:super_admin,admin'], function(){
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->middleware(['auth', 'verified'])->name('dashboard');
            
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->middleware(['auth', 'verified'])->name('dashboard');
            
            Route::middleware('auth')->group(function () {
                Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
                Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
                Route::resource('categories', CategoryController::class);
            });
        });

    });
    
    // Route::middleware('auth')->group(function () {
    //     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //     Route::get('/products' , [ProductController::class, 'index'])->name('products');
    //     Route::get('/products/create' , [ProductController::class, 'create'])->name('products.create');
    //     Route::post('/products' , [ProductController::class, 'store'])->name('products.store');
    //     Route::get('/products/{product}/edit' , [ProductController::class, 'edit'])->name('products.edit');
    //     Route::delete('/products/{product}' , [ProductController::class, 'destroy'])->name('products.destroy');

    //     Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    //     Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    //     Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    //     Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    //     Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    //     Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
    //     Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    // });
});




require __DIR__.'/auth.php';
