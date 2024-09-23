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
           Schema::create('properties', function (Blueprint $table) {
                $table->id(); // This creates an unsignedBigInteger column by default
                $table->string('name');
                $table->string('address');
                $table->string('google_maps_link')->nullable();
                $table->string('featured_image')->nullable();
                $table->decimal('area', 10, 2)->nullable();
                $table->boolean('jacuzzi')->default(false);
                $table->integer('bed')->nullable();
                $table->decimal('price', 15, 2)->nullable();
                $table->decimal('sale_price', 15, 2)->nullable();
                $table->boolean('is_featured')->default(false);
                $table->boolean('is_private')->default(false);
                $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null');
                $table->unsignedBigInteger('category_id')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
