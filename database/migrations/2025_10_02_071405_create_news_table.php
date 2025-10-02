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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->enum('type', ['events', 'launches'])->nullable();
            $table->boolean('is_featured')->default(false);
            $table->string('img')->nullable();

            $table->string('paragraph_one_title')->nullable();
            $table->longText('paragraph_one_description')->nullable();
            $table->string('paragraph_one_img')->nullable();

            $table->string('paragraph_two_title')->nullable();
            $table->longText('paragraph_two_description')->nullable();
            $table->string('paragraph_two_img')->nullable();

            $table->string('paragraph_three_title')->nullable();
            $table->longText('paragraph_three_description')->nullable();
            $table->string('paragraph_three_img')->nullable();

            $table->string('youtube_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('linkdin_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
