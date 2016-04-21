<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('rentalDate');
            $table->datetime('returnDate');
            $table->integer('inventory_id')->unsigned();
            $table->foreign('inventory_id')
                  ->references('id')
                  ->on('inventories');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('users');
            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')
                  ->references('id')
                  ->on('users');
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
        Schema::drop('rentals');
    }
}
