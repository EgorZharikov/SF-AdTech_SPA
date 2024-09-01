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
        Schema::create('redirects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id');
            $table->decimal('fee')->nullable(false);
            $table->integer('ip')->unsigned();
            $table->boolean('status');
            $table->decimal('offer_award')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('subscription_id', 'redirect_subscription_idx');
            $table->foreign('subscription_id', 'redirect_subscription_fk')->references('id')->on('subscriptions')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redirects');
    }
};
