<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vpn_servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hostname');
            $table->string('ip_address');
            $table->string('vpn_type'); // wireguard, openvpn, l2tp, pptp
            $table->integer('port');
            $table->string('protocol')->nullable(); // udp, tcp
            $table->text('certificate')->nullable();
            $table->text('private_key')->nullable();
            $table->string('ip_range'); // CIDR notation
            $table->integer('max_connections')->default(100);
            $table->integer('current_connections')->default(0);
            $table->boolean('is_active')->default(true);
            $table->enum('status', ['online', 'offline', 'maintenance'])->default('online');
            $table->timestamps();
            $table->softDeletes();

            $table->index('vpn_type');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vpn_servers');
    }
};
