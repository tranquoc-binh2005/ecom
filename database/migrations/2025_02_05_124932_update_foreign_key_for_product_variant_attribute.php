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
        Schema::table('product_variant_attribute', function (Blueprint $table) {
            $table->dropForeign(['attribute_id']);
        });

        Schema::table('product_variant_attribute', function (Blueprint $table) {
            $table->unsignedBigInteger('attribute_value_id'); // Thêm cột mới
            $table->foreign('attribute_value_id')->references('id')->on('attribute_value')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variant_attribute', function (Blueprint $table) {
            $table->dropForeign(['attribute_value_id']);
            $table->dropColumn('attribute_value_id');
        });

        Schema::table('product_variant_attribute', function (Blueprint $table) {
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
        });
    }
};
