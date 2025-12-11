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
        if (Schema::hasTable('skill_posts')) {
            Schema::table('skill_posts', function (Blueprint $table) {
                if (!Schema::hasColumn('skill_posts', 'user_id')) {
                    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('id');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('skill_posts')) {
            Schema::table('skill_posts', function (Blueprint $table) {
                if (Schema::hasColumn('skill_posts', 'user_id')) {
                    $table->dropForeignKey(['user_id']);
                    $table->dropColumn('user_id');
                }
            });
        }
    }
};
