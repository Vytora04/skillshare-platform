<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skill_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['offer', 'need']);
            $table->string('skills')->nullable();
            $table->string('location')->nullable();
            $table->string('time_commitment')->nullable();
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skill_posts');
    }
};
