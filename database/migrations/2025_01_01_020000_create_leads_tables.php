<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('leads', function(Blueprint $t){
      $t->id();
      $t->string('name');
      $t->string('phone')->index();
      $t->string('source')->nullable();
      $t->json('interest_subjects')->nullable();
      $t->enum('status',['new','contacted','trial','won','lost'])->default('new');
      $t->foreignId('owner_id')->constrained('users');
      $t->foreignId('branch_id')->constrained('branches');
      $t->timestamp('next_action_at')->nullable();
      $t->text('notes')->nullable();
      $t->timestamps();
    });
    Schema::create('lead_followups', function(Blueprint $t){
      $t->id();
      $t->foreignId('lead_id')->constrained('leads')->cascadeOnDelete();
      $t->text('note')->nullable();
      $t->enum('outcome',['scheduled_trial','callback','no_answer','won','lost']);
      $t->timestamp('followup_at')->nullable();
      $t->foreignId('created_by')->constrained('users');
      $t->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('lead_followups');
    Schema::dropIfExists('leads');
  }
};
