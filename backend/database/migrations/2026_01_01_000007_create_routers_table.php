<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('routers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->string('hostname')->nullable();
            $table->string('ip_address');
            $table->integer('api_port')->default(8728);
            $table->boolean('api_ssl')->default(false);
            $table->string('api_username');
            $table->text('api_password'); // Encrypted
            $table->string('model')->nullable();
            $table->string('routeros_version')->nullable();
            $table->string('mac_address')->nullable();
            $table->boolean('is_connected')->default(false);
            $table->dateTime('last_sync_at')->nullable();
            $table->integer('latency_ms')->default(0);
            $table->float('cpu_usage')->default(0);
            $table->float('ram_usage')->default(0);
            $table->float('disk_usage')->default(0);
            $table->float('temperature')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'inactive', 'error'])->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('ip_address');
            $table->index('is_connected');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('routers');
    }
};
