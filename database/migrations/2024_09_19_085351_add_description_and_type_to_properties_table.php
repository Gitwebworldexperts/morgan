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
        Schema::table('properties', function (Blueprint $table) {
            $table->text('description')->nullable(); // Add description column
            $table->string('type')->nullable()->default('residential'); // Add type column with default value
            $table->string('tag')->nullable(); // Add tag column
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active'); // Add status column as enum
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('description'); // Remove description column
            $table->dropColumn('type'); // Remove type column
            $table->dropColumn('tag'); // Remove tag column
            $table->dropColumn('status'); // Remove status column
        });
    }
};
