<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('workouts', function (Blueprint $table) {
            $table->id('workout_id');
            $table->string('workout_name', 100);
            $table->string('kategori', 50);
            $table->text('deskripsi')->nullable();
            $table->integer('kalori');
            $table->integer('durasi'); // dalam menit
            $table->string('difficulty', 20)->default('Medium');
            $table->integer('total_sets')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('workouts');
    }
};