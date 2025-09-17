<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentReviewController;

Route::middleware(['auth'])->group(function () {
  Route::get('payments/review', [PaymentReviewController::class,'index'])->name('payments.review.index');
  Route::get('payments/{payment}', [PaymentReviewController::class,'show'])->name('payments.review.show');
  Route::post('payments/{payment}/status', [PaymentReviewController::class,'updateStatus'])->name('payments.review.status');
});
