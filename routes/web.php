<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ProfileController, PaymentReviewController, InvoiceController, PaymentController};

Route::get('/', fn () => view('welcome'));
Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth','verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Payments review
    Route::get('payments/review',           [PaymentReviewController::class,'index'])->name('payments.review.index');
    Route::get('payments/{payment}',        [PaymentReviewController::class,'show'])->name('payments.review.show');
    Route::post('payments/{payment}/status',[PaymentReviewController::class,'updateStatus'])->name('payments.review.status');

    // Invoices
    Route::resource('invoices', InvoiceController::class)->only(['index','show']);
    Route::post('invoices/{invoice}/pay', [PaymentController::class,'store'])->name('invoices.pay');
});

require __DIR__.'/auth.php';
