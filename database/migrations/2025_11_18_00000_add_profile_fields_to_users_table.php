<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            if (!Schema::hasColumn('users', 'dob')) {
                $table->date('dob')->nullable();
            }
            
            if (!Schema::hasColumn('users', 'weight')) {
                $table->decimal('weight', 5, 2)->nullable()->comment('Weight in kg');
            }
            
            if (!Schema::hasColumn('users', 'height')) {
                $table->decimal('height', 5, 2)->nullable()->comment('Height in cm');
            }
            
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable();
            }

            // address sengaja dihapus dari migration ini
            // karena sudah pernah dibuat sebelumnya
            
            if (!Schema::hasColumn('users', 'profile_picture')) {
                $table->string('profile_picture')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'dob',
                'weight',
                'height',
                'phone',
                'profile_picture'
                // address TIDAK boleh di-drop karena tidak ditambah di file ini
            ]);
        });
    }
};
