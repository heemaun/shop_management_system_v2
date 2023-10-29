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
        Schema::create('image_objects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained('statuses','id');
            $table->foreignId('user_id')->nullable()->constrained('users','id');
            $table->foreignId('product_id')->nullable()->constrained('products','id');
            $table->foreignId('setting_id')->nullable()->constrained('settings','id');
            $table->string('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_objects');
    }
};
