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
        Schema::create('resume_items', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // experience, systemic_education, course, license, certificate
            $table->string('title');
            $table->string('subtitle')->nullable(); // Issuer / Institution
            $table->string('date_range')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable(); // Proof/Certificate image
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resume_items');
    }
};
