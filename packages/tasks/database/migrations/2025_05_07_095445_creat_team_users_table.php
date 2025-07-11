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
       Schema::create('team_users', function (Blueprint $table) {
       $table->id();
       $table->boolean('is_manger')->default(0);
       $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
       $table->foreignId('team_id')->constrained('teams')->cascadeOnDelete()->cascadeOnUpdate();
       $table->timestamps();
       });
       }

       /**
       * Reverse the migrations.
       */
       public function down(): void
       {
       Schema::dropIfExists('teamMembers');
       }
};
