<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventOrganizer\EventController;
use App\Http\Controllers\EventOrganizer\PresenceController;
use App\Http\Controllers\EventRequestController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdditionalFeeController;

Route::get('/', [ExploreController::class, 'index'])->name('explore');

Route::get('/event-register/{slug}', [ExploreController::class, 'show'])->name('event-register');
Route::post('/payment/handler', [ExploreController::class, 'paymentHandler'])->name('payment-handler');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // For Event Organizer
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('event', EventController::class);
    Route::delete('/event/{id}/delete-image', 'EventController@deleteImage')->name('event.deleteImage');
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);


    // For Attender 
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{productId}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update-quantity/{cartId}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

    Route::get('/history', [OrderController::class, 'index'])->name('history');
    Route::get('/history/order/{invoiceId}', [OrderController::class, 'show'])->name('history.detail');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/store_zero_amount', [OrderController::class, 'store_zero_amount'])->name('orders.store_zero_amount');
    // Route::post('/request/approval/{uniqueCode}', [OrderController::class, 'requestAccess'])->name('request-approval');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    
    Route::post('/event-request', [EventRequestController::class, 'requestApproval'])->name('event.request.approval');
    Route::resource('presence', PresenceController::class);
    Route::post('/qr-scan', [PresenceController::class, 'scanQR'])->name('qr.scan');
    
    Route::post('/event-request/{id}/approve', [PresenceController::class, 'approve'])->name('event.request.approve');
    Route::post('/event-request/{id}/reject', [PresenceController::class, 'reject'])->name('event.request.reject');
    Route::post('/event-request/{id}/pending', [PresenceController::class, 'pending'])->name('event.request.pending');
    
    Route::resource('bank-accounts', BankAccountController::class)->only(['index', 'create', 'store']);
    Route::resource('withdrawals', WithdrawalController::class)->only(['index', 'create', 'store', 'show', 'update']);


    Route::resource('additional-fees', AdditionalFeeController::class);

});

Route::post('/transactions/notification', [TransactionController::class, 'notification'])->name('transactions.notification');

require __DIR__.'/auth.php';
