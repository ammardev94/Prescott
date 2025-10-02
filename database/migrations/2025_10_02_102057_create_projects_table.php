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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail_img')->nullable();
            $table->string('title');
            $table->string('location')->nullable();
            $table->enum('status', ['completed', 'ongoing'])->default('ongoing');
            $table->string('video_thumbnail_img')->nullable();
            $table->string('video')->nullable();
            $table->longText('overview')->nullable();
            $table->string('brochure')->nullable();
            $table->string('total_area')->nullable();
            $table->string('open_space')->nullable();
            $table->string('polo_field_n_stable_expanse')->nullable();
            $table->string('clubhouse_gfa')->nullable();
            $table->string('mix_use_gfa')->nullable();
            $table->string('residential_cluster')->nullable();
            $table->string('resident_population')->nullable();
            $table->string('residences')->nullable();
            $table->string('reception_img')->nullable();
            $table->string('exterior_img')->nullable();
            $table->string('interior_img')->nullable();
            $table->string('section_one_img')->nullable();
            $table->string('amenities_brochure')->nullable();
            $table->longText('location_overview')->nullable();
            $table->string('location_map_url')->nullable();
            $table->json('near_by_entertainment')->nullable();
            $table->json('near_by_schools')->nullable();
            $table->json('near_by_clinics')->nullable();
            $table->longText('map_iframe')->nullable();
            $table->string('section_two_img')->nullable();
            $table->string('trademark_interior_img')->nullable();
            $table->longText('trademark_interior_description')->nullable();
            $table->string('trademark_interior_brochure')->nullable();
            $table->string('section_three_img')->nullable();
            $table->string('construction_update_img')->nullable();
            $table->date('construction_update_date')->nullable();
            $table->string('construction_plan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
