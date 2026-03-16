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
            // Clean up any leftover columns from failed migrations
            if (Schema::hasColumn('users', 'areas_of_interest_old')) {
                $table->dropColumn('areas_of_interest_old');
            }
            if (!Schema::hasColumn('users', 'isced_codes')) {
                $table->json('isced_codes')->nullable()->after('areas_of_interest');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
