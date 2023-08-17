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
        Schema::create('sell_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained('statuses','id');
            $table->foreignId('admin_id')->nullable()->constrained('users','id');
            $table->foreignId('sell_id')->constrained('sells','id');
            $table->foreignId('product_id')->constrained('products','id');
            $table->float('units')->default(0);
            $table->float('price')->default(0);
            $table->float('discount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_orders');
    }
};
