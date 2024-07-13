<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EventOrganizer\CategoryController;
use App\Http\Controllers\EventOrganizer\EventController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExploreController::class, 'index'])->name('explore');

Route::get('/event/{slug}', [ExploreController::class, 'show'])->name('detail-event');
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
    Route::resource('category', CategoryController::class);
    Route::resource('user', UserController::class);

    // For Attender 
    Route::get('/schedule', function () {
        return view('schedule');
    })->name('schedule');
    
    Route::get('/history', function () {
        return view('history');
    })->middleware(['auth', 'verified'])->name('history');
    
});

require __DIR__.'/auth.php';
