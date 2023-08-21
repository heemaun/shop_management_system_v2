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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('status_id')->constrained('statuses','id')->onDelete('cascade');
            $table->foreignId('admin_id')->constrained('users','id')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories','id')->onDelete('cascade');
            $table->string('name');
            $table->float('units')->default(0);
            $table->float('price')->default(0);
            $table->string('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
