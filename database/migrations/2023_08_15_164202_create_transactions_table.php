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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained('statuses','id')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users','id')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('users','id')->onDelete('cascade');
            $table->foreignId('account_id')->constrained('accounts','id')->onDelete('cascade');
            $table->float('amount')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
