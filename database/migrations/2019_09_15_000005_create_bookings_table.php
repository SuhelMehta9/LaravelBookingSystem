<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');

            $table->date('start_date');

            $table->time('start_time');

            $table->date('end_date');

            $table->time('end_time');

            $table->string('name');

            $table->string('email');

            $table->string('phone_number');

            $table->longText('description');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
