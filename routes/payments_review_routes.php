<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
  Route::get('payments/review', [\App\Http\Controllers\PaymentReviewController::class,'index'])->name('payments.review.index');
  Route::get('payments/{payment}', [\App\Http\Controllers\PaymentReviewController::class,'show'])->name('payments.review.show');
  Route::post('payments/{payment}/status', [\App\Http\Controllers\PaymentReviewController::class,'updateStatus'])->name('payments.review.status');
});
