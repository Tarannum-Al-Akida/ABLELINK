<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();

            $table->string('kind'); // video | audio | document | link
            $table->string('title')->nullable();

            // Provide either a local file (media_path) OR an external URL.
            $table->string('external_url')->nullable();
            $table->string('media_path')->nullable();
            $table->string('mime_type')->nullable();

            // Accessibility
            $table->string('captions_path')->nullable(); // .vtt
            $table->string('captions_language')->nullable(); // e.g. en
            $table->longText('transcript')->nullable();
            $table->string('audio_description_path')->nullable(); // separate audio track

            // Ordering / UX
            $table->boolean('is_primary')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['course_id', 'kind']);
            $table->index(['course_id', 'is_primary']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_media');
    }
};

