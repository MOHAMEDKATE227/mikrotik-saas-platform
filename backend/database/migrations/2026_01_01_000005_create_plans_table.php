<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('monthly_price', 10, 2);
            $table->decimal('yearly_price', 10, 2)->nullable();
            $table->integer('max_routers')->default(5);
            $table->integer('max_vpn_users')->default(100);
            $table->integer('max_mikhmon_instances')->default(1);
            $table->integer('max_support_tickets')->default(10);
            $table->boolean('includes_backup')->default(true);
            $table->boolean('includes_monitoring')->default(true);
            $table->boolean('includes_2fa')->default(true);
            $table->boolean('includes_api_access')->default(true);
            $table->integer('api_rate_limit')->default(1000);
            $table->json('features')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
