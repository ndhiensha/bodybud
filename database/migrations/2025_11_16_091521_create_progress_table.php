<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id('progress_id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('workout_id')->constrained('workouts', 'workout_id')->onDelete('cascade');
            $table->integer('completed_sets')->default(0);
            $table->integer('total_sets');
            $table->float('progress_percentage', 5, 2)->default(0);
            $table->enum('status', ['In Progress', 'Completed', 'Stopped'])->default('In Progress');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('progress');
    }
};