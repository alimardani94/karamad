<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->foreignId('owner_id')->index();
            $table->string('name');
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedSmallInteger('status')->default(0);
            $table->unsignedSmallInteger('type');
            $table->unsignedBigInteger('quantity')->nullable();
            $table->string('file')->nullable();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedSmallInteger('discount_type')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->text('attachment')->nullable();
            $table->text('features')->nullable();
            $table->text('summery')->nullable();
            $table->text('description')->nullable();
            $table->text('images');
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();

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
        Schema::dropIfExists('products');
    }
}
