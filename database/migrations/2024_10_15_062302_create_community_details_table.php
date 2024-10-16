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
        Schema::create('community_details', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->string('bg_image');
            $table->text('second_section');
            $table->text('insights');
            $table->enum('featured_property', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_details');
    }
};
