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
        Schema::create('extra_profits', function (Blueprint $table) {
            $table->id();
            $table->decimal('profit');
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('product_sales_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_profits');
    }
};
