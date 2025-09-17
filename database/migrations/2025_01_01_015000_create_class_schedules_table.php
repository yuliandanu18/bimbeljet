<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('class_schedules', function(Blueprint $t){
      $t->id();
      $t->foreignId('class_id')->constrained('classes');
      $t->unsignedTinyInteger('weekday'); // 0=Sun
      $t->time('start_time');
      $t->time('end_time');
      $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('class_schedules'); }
};
