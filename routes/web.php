<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EventOrganizer\CategoryController;
use App\Http\Controllers\EventOrganizer\EventController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExploreController::class, 'index'])->name('explore');

Route::get('/event-register/{slug}', [ExploreController::class, 'show'])->name('event-register');
Route::post('/payment/handler', [ExploreController::class, 'paymentHandler'])->name('payment-handler');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // For Event Organizer
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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
    Route::post('/transactions/notification', [TransactionController::class, 'notification'])->name('transactions.notification');
});

require __DIR__.'/auth.php';
