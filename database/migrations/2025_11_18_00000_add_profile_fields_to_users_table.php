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
        Schema::table('users', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['male', 'female'])->nullable()->after('email');
                

            }
            
            if (!Schema::hasColumn('users', 'dob')) {
                $table->date('dob')->nullable()->after('gender');
            }
            
            if (!Schema::hasColumn('users', 'weight')) {
                $table->decimal('weight', 5, 2)->nullable()->after('dob')->comment('Weight in kg');
            }
            
            if (!Schema::hasColumn('users', 'height')) {
                $table->decimal('height', 5, 2)->nullable()->after('weight')->comment('Height in cm');
            }
            
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 20)->nullable()->after('height');
            }
            
            if (!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }
            
            if (!Schema::hasColumn('users', 'profile_picture')) {
                $table->string('profile_picture')->nullable()->after('address');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'gender',
                'dob',
                'weight',
                'height',
                'phone',
                'address',
                'profile_picture'
            ]);
        });
    }
};