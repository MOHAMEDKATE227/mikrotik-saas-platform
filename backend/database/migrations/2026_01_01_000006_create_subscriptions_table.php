<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('plan_id')->constrained('plans')->restrictOnDelete();
            $table->string('stripe_subscription_id')->nullable();
            $table->enum('billing_cycle', ['monthly', 'yearly'])->default('monthly');
            $table->decimal('current_balance', 10, 2)->default(0);
            $table->decimal('total_spent', 10, 2)->default(0);
            $table->dateTime('started_at');
            $table->dateTime('renews_at')->nullable();
            $table->dateTime('cancelled_at')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended', 'cancelled'])->default('active');
            $table->boolean('auto_renew')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('user_id');
            $table->index('status');
            $table->index('renews_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
