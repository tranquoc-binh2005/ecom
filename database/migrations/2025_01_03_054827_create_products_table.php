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
            $table->unsignedBigInteger('product_catalogue_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('product_catalogue_id')->references('id')->on('product_catalogue')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('product_brand')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->longText('album')->nullable();
            $table->string('image')->nullable();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('stock')->nullable();
            $table->tinyInteger('publish')->default(1);
            $table->integer('sold')->default(0);
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
