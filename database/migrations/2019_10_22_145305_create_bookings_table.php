<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('bookingReference');
            $table->unsignedBigInteger('cartypeId');
            $table->unsignedBigInteger('statusId');
            $table->timestamps();

            $table->foreign('cartypeId')
            ->references('id')->on('car_types')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('statusId')
            ->references('id')->on('statuses')
            ->onUpdate('cascade')
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
        Schema::dropIfExists('bookings');
    }
}
