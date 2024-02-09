<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use App\Mail\ProposalSend;
use App\Models\Transaction;
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


Route::group(['prefix'=>'paypal'], function(){
    Route::post('/order/create',[PaymentController::class,'create'])->name('paypal-create');
    Route::post('/order/capture',[PaymentController::class,'capture'])->name('paypal-capture');
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
            Route::get('/transaction/{transaction}', [TransactionsController::class, 'show'])->name('transaction.show');
            Route::get('/transaction/{transaction}/payment-confirmation', [TransactionsController::class, 'paymentConfirmation'])->name('transaction.payment-confirmation');
            Route::post('/transaction/{transaction}/payment-confirmation', [TransactionsController::class, 'requestConfirmation'])->name('transaction.payment-confirmation.store');
            Route::get('/transaction/{transaction}/invoice', [TransactionsController::class, 'invoice'])->name('transaction.invoice');
            Route::post('/transaction/{transaction}/approval-revision', [TransactionsController::class, 'approvalRevision'])->name('transaction.approval-revision');
            Route::post('/transaction/{transaction}/review', [TransactionsController::class, 'review'])->name('transaction.review');

            Route::get('/transaction/{transaction}/download-product', [TransactionsController::class, 'downloadProduct'])->name('transaction.download-product');
        });
    });

});



Route::group(['middleware' => 'role:super_admin,admin'], function(){
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {
            
            // Route::get('/dashboard', function () {
            //     return view('dashboard');
            // })->middleware(['auth', 'verified'])->name('dashboard');
            Route::get('/dashboard/{status?}', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
            
            Route::middleware('auth')->group(function () {

                Route::get('/mailable', function () {
                    $transaction = Transaction::where('id',11)->with(['proposal', 'user'])->first();
                    return new ProposalSend($transaction);
                });

                Route::post('/proposal/send', [DashboardController::class, 'sendProposal'])->name('proposal.send');

                Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
                Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
                Route::resource('categories', CategoryController::class);
                Route::resource('products', ProductController::class);

                Route::post('/transactions/{transaction}/approval-payment', [TransactionController::class, 'approvalPayment'])->name('transactions.approval-payment');
                Route::post('/transactions/{transaction}/upload-product', [TransactionController::class, 'uploadProduct'])->name('transactions.upload-product');
                Route::get('/transactions/{transaction}/download-product', [TransactionController::class, 'downloadProduct'])->name('transactions.download-product');
                Route::resource('transactions', TransactionController::class);
                
                Route::resource('discounts', DiscountController::class);
                Route::resource('users', UserController::class);
            });
        });

    });
});




require __DIR__.'/auth.php';
