<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_activity_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('activity_type');
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('last_login');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_activity_logs');
    }
};