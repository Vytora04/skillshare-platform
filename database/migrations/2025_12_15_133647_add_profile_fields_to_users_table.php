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
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('email');
            $table->json('skills')->nullable()->after('bio');
            $table->string('portfolio_url')->nullable()->after('skills');
            $table->string('location')->nullable()->after('portfolio_url');
            $table->string('availability')->nullable()->after('location');
            $table->string('avatar')->nullable()->after('availability');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'skills', 'portfolio_url', 'location', 'availability', 'avatar']);
        });
    }
};
