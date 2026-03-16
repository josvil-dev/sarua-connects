<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add isced_codes field if it doesn't exist
        if (!Schema::hasColumn('users', 'isced_codes')) {
            Schema::table('users', function (Blueprint $table) {
                $table->json('isced_codes')->nullable()->after('areas_of_interest');
            });
        }

        // Check if areas_of_interest is already JSON (if migration already ran partially)
        $column = DB::select("SHOW COLUMNS FROM users WHERE Field = 'areas_of_interest'")[0];
        if (strpos($column->Type, 'json') === false) {
            // Convert existing areas_of_interest from text to JSON format
            // First, let's temporary rename the column
            Schema::table('users', function (Blueprint $table) {
                $table->renameColumn('areas_of_interest', 'areas_of_interest_old');
            });

            // Add new JSON column
            Schema::table('users', function (Blueprint $table) {
                $table->json('areas_of_interest')->nullable()->after('keywords');
            });

            // Migrate existing text data to JSON format
            $users = DB::table('users')->whereNotNull('areas_of_interest_old')->orderBy('id')->get();
            foreach ($users as $user) {
                if (!empty($user->areas_of_interest_old)) {
                    // Convert comma-separated string to array
                    $interests = array_map('trim', explode(',', $user->areas_of_interest_old));
                    DB::table('users')->where('id', $user->id)
                        ->update(['areas_of_interest' => json_encode($interests)]);
                }
            }

            // Drop the old column
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('areas_of_interest_old');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Convert JSON back to text
        Schema::table('users', function (Blueprint $table) {
            $table->text('areas_of_interest_old')->nullable()->after('keywords');
        });

        // Migrate JSON data back to text format
        $users = DB::table('users')->whereNotNull('areas_of_interest')->orderBy('id')->get();
        foreach ($users as $user) {
            if (!empty($user->areas_of_interest)) {
                $interests = json_decode($user->areas_of_interest, true);
                if (is_array($interests)) {
                    DB::table('users')->where('id', $user->id)
                        ->update(['areas_of_interest_old' => implode(', ', $interests)]);
                }
            }
        }

        // Drop JSON columns and rename old back
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['areas_of_interest', 'isced_codes']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('areas_of_interest_old', 'areas_of_interest');
        });
    }
};
