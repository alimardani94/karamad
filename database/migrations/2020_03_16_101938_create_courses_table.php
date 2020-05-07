<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructor_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('title');
            $table->text('summary');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('discount')->default(0);
            $table->integer('sell_count')->default(0);
            $table->integer('seen_count')->default(0);
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
        Schema::dropIfExists('courses');
    }
}
