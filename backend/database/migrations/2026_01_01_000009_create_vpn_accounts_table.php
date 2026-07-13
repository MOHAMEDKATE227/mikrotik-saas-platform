<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vpn_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained('subscriptions')->cascadeOnDelete();
            $table->foreignId('vpn_server_id')->constrained('vpn_servers')->restrictOnDelete();
            $table->string('username')->unique();
            $table->text('password'); // Encrypted
            $table->string('assigned_ip');
            $table->text('config_file')->nullable();
            $table->dateTime('created_at');
            $table->dateTime('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('data_used_mb')->default(0);
            $table->integer('data_limit_mb')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index('subscription_id');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vpn_accounts');
    }
};
