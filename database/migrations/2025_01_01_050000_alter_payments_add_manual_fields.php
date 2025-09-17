<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::table('payments', function(Blueprint $t){
      $t->enum('status',['pending','received','rejected','cancelled'])->default('pending')->after('method');
      $t->string('bank_name')->nullable()->after('status');
      $t->string('bank_ref')->nullable()->after('bank_name');
      $t->string('proof_path')->nullable()->after('bank_ref');
      $t->foreignId('verified_by')->nullable()->constrained('users')->after('ref');
      $t->timestamp('verified_at')->nullable()->after('verified_by');
      $t->text('notes')->nullable()->after('verified_at');
    });
  }
  public function down(): void {
    Schema::table('payments', function(Blueprint $t){
      $t->dropColumn(['status','bank_name','bank_ref','proof_path','verified_by','verified_at','notes']);
    });
  }
};
