<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reports_id')->unsigned();
            $table->foreignId('category_id')->unsigned();
            $table->foreign('reports_id')
              ->references('id')
              ->on('reports')
              ->onDelete('cascade');

            $table->foreign('category_id')
              ->references('id')
              ->on('categories')
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
        Schema::dropIfExists('report_category');
    }
}
