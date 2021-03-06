<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->string('commentable_type')->index();
            $table->unsignedBigInteger('commentable_id')->index();
            $table->unsignedBigInteger('parent_id')->index()->nullable();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->string('name')->nullable();
            $table->string('cell')->nullable();
            $table->string('email')->nullable();
            $table->string('ip')->index()->nullable();
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('comments');
    }
}
