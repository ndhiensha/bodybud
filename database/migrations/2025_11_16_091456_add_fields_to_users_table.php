<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->unique()->after('id');
            $table->text('biodata')->nullable()->after('email');
            $table->string('foto_profil', 255)->nullable()->after('biodata');
            $table->string('nomor_telepon', 20)->nullable()->after('foto_profil');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'biodata', 'foto_profil', 'nomor_telepon']);
        });
    }
};