<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // arm, leg, back
            $table->string('name');
            $table->text('description');
            $table->integer('calories');
            $table->integer('duration'); // dalam detik
            $table->integer('repetitions');
            $table->integer('step_order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};