<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_idea', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_id')->unsigned();
            $table->foreignId('idea_id')->unsigned();
            $table->timestamps();

            $table->foreign('categorie_id')
              ->references('id')
              ->on('categories')
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
        Schema::dropIfExists('category_idea');
    }
}
