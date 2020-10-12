<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsWilayaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports_wilaya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reports_id')->unsigned();
            $table->foreignId('wilaya_id')->unsigned();
            $table->foreign('reports_id')
              ->references('id')
              ->on('reports')
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
        Schema::dropIfExists('report_wilaya');
    }
}
