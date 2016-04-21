<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('releaseYear')->unsigned();
            $table->integer('rentalDuration')->unsigned();
            $table->decimal('rentalRate');
            $table->integer('length');
            $table->decimal('replacementCost')->unsigned();
            $table->string('rating');
            $table->integer('language_id')->unsigned();
            $table->foreign('language_id')
                  ->references('id')
                  ->on('languages');
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
        Schema::drop('films');
    }
}
