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
        Schema::create('skill_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['offer', 'need']); // I Offer / I Need
            $table->string('skills')->nullable();    // e.g. "Laravel, UI/UX"
            $table->string('location')->nullable();  // Remote / On-site / City
            $table->string('time_commitment')->nullable(); // e.g. "5 hrs/week"
            $table->text('description');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_posts');
    }
};