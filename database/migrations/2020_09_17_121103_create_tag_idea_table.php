<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_idea', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->unsigned();
            $table->foreignId('idea_id')->unsigned();
            $table->timestamps();

            $table->foreign('tag_id')
              ->references('id')
              ->on('tags')
              ->onDelete('cascade');

            $table->foreign('idea_id')
              ->references('id')
              ->on('ideas')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_idea');
    }
}
