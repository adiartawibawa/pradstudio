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
            $table->char('phone', 13)->after('password')->nullable();
            $table->text('address')->after('password')->nullable();
            $table->date('date_of_birth')->after('password')->nullable();
            $table->char('gender', 2)->after('password')->nullable();
            $table->string('profile_photo')->after('password')->nullable();
            $table->boolean('is_active')->default(true)->after('password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
            $table->dropColumn('profile_photo');
            $table->dropColumn('is_active');
        });
    }
};
