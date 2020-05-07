<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyllabusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syllabuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->index();
            $table->unsignedMediumInteger('type')->index();
            $table->string('title');
            $table->unsignedMediumInteger('file_disk')->nullable()->index();
            $table->longText('text')->nullable();
            $table->string('video')->nullable();
            $table->string('audio')->nullable();
            $table->tinyInteger('confirmed')->default(0);
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
        Schema::dropIfExists('syllabuses');
    }
}
