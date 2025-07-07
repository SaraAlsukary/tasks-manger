<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
  {
  Schema::create('tasks', function (Blueprint $table) {
  $table->id();
  $table->json('title');
  $table->json('description');
  $table->json('statue');
  $table->foreignId('proirity_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
  $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
  $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete()->cascadeOnUpdate();
  $table->timestamps();
  });
  }

  /**
  * Reverse the migrations.
  */
  public function down(): void
  {
  Schema::dropIfExists('tasks');
  }
};
