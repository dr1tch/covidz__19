<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->default(1);
            $table->string('title');
            $table->text('body');
            $table->text('image')->nullable();
            $table->text('video')->nullable();
            // $table->foreignId('source_id');
            $table->text('source');
            $table->unsignedBigInteger('likes')->default(0);
            $table->foreignId('job_id');
            $table->foreignId('disease_id');
            $table->foreignId('wilaya_id');
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
        Schema::dropIfExists('publications');
    }
}
