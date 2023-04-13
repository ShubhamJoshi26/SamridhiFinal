<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description',1000)->nullable();
            $table->string('price',1000)->nullable();
            $table->string('type')->nullable();
            $table->string('coupons')->nullable();
            $table->string('category')->nullable();
            $table->string('visibility')->nullable();
            $table->string('sku')->nullable();
            $table->string('inventory')->nullable();
            $table->string('title')->nullable();
            $table->string('weight')->nullable();
            $table->string('measurment')->nullable();
            $table->timestamps();
        });
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
