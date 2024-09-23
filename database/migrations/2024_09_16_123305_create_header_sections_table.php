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
       Schema::create('header_sections', function (Blueprint $table) {
            $table->id();
            $table->string('logo_url')->nullable();
            $table->text('navigation_links')->nullable();  // JSON or serialized array
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_sections');
    }
};
