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
            // Add indexes for commonly searched/filtered columns
            $table->index('country');
            $table->index('job_title');
            $table->index('institution');
            $table->index('registration_step');
            $table->index(['country', 'registration_step']);
            $table->index(['job_title', 'registration_step']);
            
            // Full-text indexes for search functionality
            $table->fullText(['first_name', 'last_name', 'bio', 'keywords']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['country']);
            $table->dropIndex(['job_title']);
            $table->dropIndex(['institution']);
            $table->dropIndex(['registration_step']);
            $table->dropIndex(['country', 'registration_step']);
            $table->dropIndex(['job_title', 'registration_step']);
            $table->dropFullText(['first_name', 'last_name', 'bio', 'keywords']);
        });
    }
};
