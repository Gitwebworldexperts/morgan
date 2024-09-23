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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
            // Section 1
            $table->enum('section_1', ['0', '1'])->default('1');
            $table->string('first_section_image');          
            $table->string('first_section_heading');
            $table->text('list_property');

            // Section 2
            $table->enum('section_2', ['0', '1'])->default('1');
            $table->string('second_heading');
            $table->text('second_description');
            $table->json('second_section_button');

            // Section 3
            $table->enum('section_3', ['0', '1'])->default('1');
            $table->enum('toggle_featured_property', ['0', '1'])->default('1');
            $table->json('third_section_button');

            // Section 4
            $table->enum('section_4', ['0', '1'])->default('1');
            $table->string('fourth_heading');
            $table->enum('toggle_private_property', ['0', '1'])->default('1');
            $table->text('fourth_description');
            $table->json('fourth_section_button');

            // Section 5
            $table->enum('section_5', ['0', '1'])->default('1');
            $table->string('fifth_heading');
            $table->enum('toggle_international_property', ['0', '1'])->default('1');
            $table->string('fifth_section_image');
            $table->json('fifth_section_button');

            // Section 6
            $table->enum('section_6', ['0', '1'])->default('1');
            $table->string('sixth_heading');
            $table->enum('toggle_development_property', ['0', '1'])->default('1');
            $table->json('sixth_section_button');

            // Section 7
            $table->enum('section_7', ['0', '1'])->default('1');
            $table->string('seventh_heading');

            // Section 8
            $table->enum('section_8', ['0', '1'])->default('1');
            $table->string('eighth_heading');
            $table->text('eighth_description');
            $table->json('eighth_section_button');

            // Section 9
            $table->enum('section_9', ['0', '1'])->default('1');
            $table->string('ninth_heading');
            $table->enum('toggle_blog_list', ['0', '1'])->default('1');

            // Section 10
            $table->enum('section_10', ['0', '1'])->default('1');
            $table->string('tenth_heading');
            $table->text('tenth_description');
            $table->string('tenth_section_image');
            $table->json('tenth_section_button');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_pages');
    }
};
