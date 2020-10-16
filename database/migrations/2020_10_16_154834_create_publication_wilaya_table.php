<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationWilayaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication_wilaya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publication_id')->unsigned();
            $table->foreignId('wilaya_id')->unsigned();

            $table->foreign('publication_id')
              ->references('id')
              ->on('publications')
              ->onDelete('cascade');

            $table->foreign('wilaya_id')
              ->references('id')
              ->on('wilayas')
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
        Schema::dropIfExists('publication_wilaya');
    }
}
