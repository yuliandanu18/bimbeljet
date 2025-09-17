# Upgrade Notes 0.1.x → 0.2.0

1) **Hapus migrasi duplikat** yang menambah `payments.status` jika pernah dibuat manual.
2) Migrasi skema:
   ```bash
   php artisan migrate
   ```
3) Pastikan komponen Blade ada:
   - `resources/views/components/layouts/app.blade.php`
   - `resources/views/components/card.blade.php`
4) Routes (di dalam group `auth`):
   ```php
   Route::resource('invoices', \App\Http\Controllers\InvoiceController::class)->only(['index','show']);
   Route::post('invoices/{invoice}/pay', [\App\Http\Controllers\PaymentController::class,'store'])->name('invoices.pay');

   Route::get('payments/review', [\App\Http\Controllers\PaymentReviewController::class,'index'])->name('payments.review.index');
   Route::get('payments/{payment}', [\App\Http\Controllers\PaymentReviewController::class,'show'])->name('payments.review.show');
   Route::post('payments/{payment}/status', [\App\Http\Controllers\PaymentReviewController::class,'updateStatus'])->name('payments.review.status');
   ```
5) (Opsional) `php artisan storage:link` untuk preview bukti di `/storage`.
6) (Opsional) Tambah route dev lokal untuk membuat invoice dummy:
   ```php
   Route::get('dev/make-invoice', function () {
       abort_unless(app()->environment('local'), 403);
       $branch  = \App\Models\Branch::firstOrCreate(['name'=>'Pusat']);
       $student = \App\Models\Student::firstOrCreate(['name'=>'Tester','phone'=>'08120000']);
       $inv = \App\Models\Invoice::create([
         'student_id'=>$student->id,'amount'=>250000,'due_date'=>now()->addDays(7),
         'status'=>'unpaid','branch_id'=>$branch->id,
       ]);
       return redirect()->route('invoices.show',$inv);
   })->middleware('auth');
   ```
