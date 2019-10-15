<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkingHoursTable extends Migration
{
    public function up()
    {
        Schema::table('working_hours', function (Blueprint $table) {
            $table->unsignedInteger('workinghours_id');

            $table->foreign('workinghours_id', 'workinghours_fk_293557')->references('id')->on('locations');
        });
    }
}
