<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('enrollments', function(Blueprint $t){
      $t->id();
      $t->foreignId('student_id')->constrained('students');
      $t->foreignId('class_id')->constrained('classes');
      $t->foreignId('package_id')->constrained('packages');
      $t->foreignId('sales_id')->nullable()->constrained('users');
      $t->timestamp('start_at')->nullable();
      $t->timestamp('end_at')->nullable();
      $t->enum('status',['active','paused','completed','cancelled'])->default('active');
      $t->timestamps();
    });
    Schema::create('invoices', function(Blueprint $t){
      $t->id();
      $t->foreignId('student_id')->constrained('students');
      $t->foreignId('enrollment_id')->nullable()->constrained('enrollments');
      $t->bigInteger('amount');
      $t->date('due_date');
      $t->enum('status',['unpaid','partial','paid','void'])->default('unpaid');
      $t->foreignId('branch_id')->constrained('branches');
      $t->timestamps();
    });
    Schema::create('payments', function(Blueprint $t){
      $t->id();
      $t->foreignId('invoice_id')->constrained('invoices');
      $t->enum('method',['cash','transfer','gateway']);
      $t->timestamp('paid_at');
      $t->bigInteger('amount');
      $t->string('ref')->nullable();
      $t->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('payments');
    Schema::dropIfExists('invoices');
    Schema::dropIfExists('enrollments');
  }
};
