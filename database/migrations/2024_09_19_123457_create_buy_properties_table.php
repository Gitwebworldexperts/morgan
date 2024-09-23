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
        Schema::create('buy_properties', function (Blueprint $table) {
            $table->id();
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
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->default('residential');
            $table->string('tag')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buy_properties');
    }
};
