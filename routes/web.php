<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use App\Mail\ProposalSend;
use App\Models\Category;
use App\Models\Product;
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

// Email template section
Route::get('/order-confirmation', function (){
    $product = Product::find(8);
    $transaction = Transaction::find(22);
    return new App\Mail\OrderConfirmationVtuber($transaction, $product);
});
// EOF Email template section

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/chat2', [ChatController::class, 'index2'])->name('chat.index2');
Route::post('/send-message', [ChatController::class, 'sendMessage'])->name('chat.store');
Route::post('/send-message2', [ChatController::class, 'sendMessage2'])->name('chat.store2');



Route::get('/', function () {
    $user = null;
    if(Auth::check()) {
        $user = Auth::user();
    } 

    $vtubers = Product::where('category_id', Category::VTUBER)->where('sold_out', 0)->get();
    return view('home', compact('user', 'vtubers'));
})->name('homepage');

Route::get('/ych-comission/reviews', function () {
    return view('review');
})->name('reviews');

Route::get('/ych-comission/{category?}', [ControllersProductController::class, 'index'])->name('ych-comission');

Route::get('/verify/{encrypt}', [RegisteredUserController::class, 'verifyIndex'])->name('verify.index');
Route::post('/verify', [RegisteredUserController::class, 'verify'])->name('verify.submit');

Route::group(['prefix'=>'paypal'], function(){
    Route::post('/order/create',[PaymentController::class,'create'])->name('paypal-create');
    Route::post('/order/capture',[PaymentController::class,'capture'])->name('paypal-capture');
    Route::post('/order/create-direct',[PaymentController::class,'createDirectTransaction'])->name('paypal-create-direct');
    Route::post('/order/capture-direct',[PaymentController::class,'captureDirectTransaction'])->name('paypal-capture-direct');
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
            Route::get('/vtuber/{vtuber}/adopt', [ControllersProductController::class, 'adoptVtuber'])->name('vtuber.adopt');
            Route::get('/vtuber/{vtuber}/download', [ControllersProductController::class, 'downloadVtuber'])->name('vtuber.download');

            Route::post('/product/like', [ControllersProductController::class, 'likeProduct'])->name('product.like');
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
            Route::post('/transactions/chat', [TransactionsController::class, 'messageSent'])->name('transactions.message-sent');
            Route::post('/transaction/load-channel', [TransactionsController::class, 'loadChannel'])->name('transactions.load-channel');
            Route::post('/transactions/load-messages', [TransactionsController::class, 'loadMessages'])->name('transactions.load-messages');
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

                Route::post('/products/bulk', [ProductController::class, 'bulkUpload'])->name('products.bulk');

                Route::post('/proposal/send', [DashboardController::class, 'sendProposal'])->name('proposal.send');

                Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
                Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
                Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
                Route::resource('categories', CategoryController::class);
                Route::resource('products', ProductController::class);
                
                Route::get('/transactions/download-product', [TransactionController::class, 'downloadProduct'])->name('transactions.download-product');
                Route::post('/transactions/progress', [TransactionController::class, 'progressTransaction'])->name('transactions.progress');
                Route::post('/transactions/move-to-waitlist', [TransactionController::class, 'moveToWaitlist'])->name('transactions.move-to-waitlist');
                Route::post('/transactions/mark-as-complete', [TransactionController::class, 'markAsComplete'])->name('transactions.mark-as-complete');
                Route::post('/transactions/chat', [TransactionController::class, 'messageSent'])->name('transactions.message-sent');
                Route::post('/transaction/load-channel', [TransactionController::class, 'loadChannel'])->name('transactions.load-channel');
                Route::post('/transactions/load-messages', [TransactionController::class, 'loadMessages'])->name('transactions.load-messages');

                Route::get('/vtuber/transactions', [TransactionController::class, 'vtubersIndex'])->name('vtubers.index');
                Route::get('/vtuber/{transaction}/show', [TransactionController::class, 'vtubersShow'])->name('vtubers.show');
                Route::resource('transactions', TransactionController::class);
                
                Route::resource('discounts', DiscountController::class);
                Route::resource('users', UserController::class);
                Route::resource('reviews', ReviewController::class);
                Route::resource('reports', ReportController::class);
            });
        });

    });
});




require __DIR__.'/auth.php';
