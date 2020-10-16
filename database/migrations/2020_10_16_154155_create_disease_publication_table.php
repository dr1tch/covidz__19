<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiseasePublicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_publication', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publication_id')->unsigned();
            $table->foreignId('disease_id')->unsigned();

            $table->foreign('publication_id')
              ->references('id')
              ->on('publications')
              ->onDelete('cascade');

            $table->foreign('disease_id')
              ->references('id')
              ->on('diseases')
              ->onDelete('cascade');

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
        Schema::dropIfExists('disease_publication');
    }
}
