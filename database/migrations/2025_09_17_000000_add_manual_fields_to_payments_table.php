<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::table('payments', function(Blueprint $t){
      if (!Schema::hasColumn('payments','status')) {
        $t->enum('status',['pending','received','rejected','cancelled'])->default('pending')->after('method');
      }
      if (!Schema::hasColumn('payments','bank_name'))  { $t->string('bank_name')->nullable()->after('status'); }
      if (!Schema::hasColumn('payments','bank_ref'))   { $t->string('bank_ref')->nullable()->after('bank_name'); }
      if (!Schema::hasColumn('payments','proof_path')) { $t->string('proof_path')->nullable()->after('bank_ref'); }
      if (!Schema::hasColumn('payments','verified_by')){ $t->foreignId('verified_by')->nullable()->constrained('users')->after('ref'); }
      if (!Schema::hasColumn('payments','verified_at')){ $t->timestamp('verified_at')->nullable()->after('verified_by'); }
      if (!Schema::hasColumn('payments','notes'))      { $t->text('notes')->nullable()->after('verified_at'); }
    });
  }
  public function down(): void {
    Schema::table('payments', function(Blueprint $t){
      if (Schema::hasColumn('payments','verified_by')) { $t->dropConstrainedForeignId('verified_by'); }
      foreach (['status','bank_name','bank_ref','proof_path','verified_at','notes'] as $col) {
        if (Schema::hasColumn('payments',$col)) { $t->dropColumn($col); }
      }
    });
  }
};
