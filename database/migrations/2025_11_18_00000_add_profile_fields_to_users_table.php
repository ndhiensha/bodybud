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
            $table->enum('gender', ['Male', 'Female'])->nullable()->after('email');
            $table->date('dob')->nullable()->after('gender');
            $table->decimal('weight', 5, 2)->nullable()->after('dob');
            $table->decimal('height', 5, 2)->nullable()->after('weight');
            $table->string('phone', 20)->nullable()->after('height');
            $table->text('address')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gender', 'dob', 'weight', 'height', 'phone', 'address']);
        });
    }
};