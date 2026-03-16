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
            // Stage 1 fields (split name into first_name and last_name)
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            
            // Stage 2 fields
            $table->string('title')->nullable()->after('last_name');
            $table->string('highest_qualification')->nullable()->after('title');
            $table->string('institution')->nullable()->after('highest_qualification');
            $table->string('job_title')->nullable()->after('institution');
            $table->string('country')->nullable()->after('job_title');
            $table->string('photo')->nullable()->after('country');
            $table->string('cv')->nullable()->after('photo');
            
            // Stage 3 fields
            $table->text('bio')->nullable()->after('cv');
            $table->text('keywords')->nullable()->after('bio');
            $table->text('areas_of_interest')->nullable()->after('keywords');
            
            // Registration step tracking
            $table->integer('registration_step')->default(1)->after('areas_of_interest');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'title', 'highest_qualification',
                'institution', 'job_title', 'country', 'photo', 'cv',
                'bio', 'keywords', 'areas_of_interest', 'registration_step'
            ]);
        });
    }
};
