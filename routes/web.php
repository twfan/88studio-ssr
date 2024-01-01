<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Auth;
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
    $user = null;
    if(Auth::check()) {
        $user = Auth::user();
    } 
    return view('home', compact('user'));
});

Route::get('/ych-comission/{category?}', [ControllersProductController::class, 'index'])->name('ych-comission');

// Route::get('/member', function () {
//     return view('member');
// })->name('member-login');
// Route::get('/member/register', function () {
//     return view('member-register');
// })->name('member-register');

// Route::get('/member/login', function () {
//     return view('member');
// });


Route::get('/transaction', function() {
    return view('member.transaction');
});



Route::name('member.')->group(function () {
    Route::prefix('member')->group(function () {
        Route::get('/', function () {
            return view('member'); 
        })->name('login');

        Route::get('/register', function () {
            return view('member-register');
        })->name('register');
        
        
        Route::group(['middleware' => 'role:user'], function () {
            Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
            Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
            Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

            Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

            Route::get('/transaction', [TransactionsController::class, 'index'])->name('transaction.index');
            Route::get('/transaction/{transaction}/payment-confirmation', [TransactionsController::class, 'paymentConfirmation'])->name('transaction.payment-confirmation');
            Route::post('/transaction/{transaction}/payment-confirmation', [TransactionsController::class, 'paymentConfirmationStore'])->name('transaction.payment-confirmation.store');

            Route::get('/transaction/{transaction}/invoice', [TransactionsController::class, 'invoice'])->name('transaction.invoice');
        });
    });

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
                Route::resource('products', ProductController::class);
                Route::resource('transactions', TransactionController::class);
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
