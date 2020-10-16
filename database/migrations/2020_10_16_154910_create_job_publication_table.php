<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPublicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_publication', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publication_id')->unsigned();
            $table->foreignId('job_id')->unsigned();

            $table->foreign('publication_id')
              ->references('id')
              ->on('publications')
              ->onDelete('cascade');

            $table->foreign('job_id')
              ->references('id')
              ->on('jobs')
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
        Schema::dropIfExists('job_publication');
    }
}
