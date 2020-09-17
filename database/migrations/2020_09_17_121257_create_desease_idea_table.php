<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeseaseIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_idea', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disease_id')->unsigned();
            $table->foreignId('idea_id')->unsigned();
            $table->timestamps();

            $table->foreign('disease_id')
              ->references('id')
              ->on('diseases')
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
        Schema::dropIfExists('desease_idea');
    }
}
