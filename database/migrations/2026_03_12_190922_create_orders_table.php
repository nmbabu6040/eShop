<?php

use App\Models\Coupon;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique()->nullable();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->float('charge')->default(0);
            $table->float('total_price')->default(0);
            $table->boolean('has_coupon')->default(false);
            $table->foreignIdFor(Coupon::class)->nullable()->constrained()->cascadeOnDelete();
            $table->string('status')->nullable();
            $table->string('payment_method')->nullable();
            $table->boolean('hasPayment')->default(false);
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
