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
        Schema::table('rent_properties', function (Blueprint $table) {
            // $table->string('slug')->nullable()->after('id');
            // $table->string('description')->nullable()->after('name');
            $table->integer('agent')->nullable();
            $table->string('floor_plan')->nullable();
            $table->string('brochure')->nullable();
            $table->string('information_heading')->nullable();
            $table->string('information_description')->nullable();
            $table->string('information_button_label')->nullable();
            $table->string('information_button_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rent_properties', function (Blueprint $table) {
            //
        });
    }
};
