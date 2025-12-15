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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_post_id')->constrained()->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['invite', 'apply']); // seeker invites provider OR provider applies to need
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->text('message')->nullable();
            $table->timestamps();
            
            // Prevent duplicate invitations
            $table->unique(['skill_post_id', 'sender_id', 'receiver_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
