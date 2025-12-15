<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add role column - users can have multiple roles via JSON array
            $table->json('roles')->default('["user"]')->after('remember_token');
        });

        // Migrate existing is_admin and is_moderator to new role system
        DB::table('users')->update(['roles' => DB::raw("'[\"user\"]'")]);
        
        $admins = DB::table('users')->where('is_admin', true)->get();
        foreach ($admins as $admin) {
            DB::table('users')->where('id', $admin->id)->update(['roles' => '["admin"]']);
        }
        
        $moderators = DB::table('users')->where('is_moderator', true)->get();
        foreach ($moderators as $moderator) {
            DB::table('users')->where('id', $moderator->id)->update(['roles' => '["moderator"]']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('roles');
        });
    }
};
