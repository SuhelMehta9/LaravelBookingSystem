<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingHoursTable extends Migration
{
    public function up()
    {
        Schema::create('working_hours', function (Blueprint $table) {
            $table->increments('id');

            $table->time('startworkinghour');

            $table->time('endworkinghour');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
