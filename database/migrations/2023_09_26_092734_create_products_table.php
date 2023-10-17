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
            $table->string('title')->unique();
            $table->string('author')->nullable();
            $table->string('isbn')->unique();
            $table->string('genre')->nullable();
            $table->decimal('buy_price');
            $table->decimal('sale_price');
            $table->decimal('disc')->nullable();
            $table->integer('quantity');
            $table->string('type');
            $table->date('published_date')->nullable();
            $table->string('publisher')->nullable();
            $table->string('cover_image_path')->nullable();
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
