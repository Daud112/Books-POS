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
        Schema::table('extra_profit', function (Blueprint $table) {
            $table->foreign('product_sales_id')->references('id')->on('product_sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('extra_profit', function (Blueprint $table) {
            $table->dropForeign('extra_profit_product_sales_id_foreign');
            $table->dropColumn('product_sales_id');
        });
    }
};
