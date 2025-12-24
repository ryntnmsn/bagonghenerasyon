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
            $table->string('first_name')->nullable()->after('id');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('username')->nullable()->after('email');
            $table->string('phone_number')->nullable()->after('username');
            $table->date('birth_date')->nullable()->after('phone_number');
            $table->string('gender')->nullable()->after('birth_date');
            $table->string('user_type')->default('user')->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('birth_date');
            $table->dropColumn('gender');
            $table->dropColumn('user_type');
        });
    }
};
