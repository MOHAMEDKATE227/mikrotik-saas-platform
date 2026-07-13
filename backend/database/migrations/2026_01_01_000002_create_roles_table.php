<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'System administrator with full access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrator with extended access',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reseller',
                'slug' => 'reseller',
                'description' => 'Reseller account for white-label services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Client',
                'slug' => 'client',
                'description' => 'Regular client user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
