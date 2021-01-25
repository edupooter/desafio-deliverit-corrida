<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRaceRunnersTable extends Migration
{
    public function up()
    {
        Schema::table('race_runners', function (Blueprint $table) {
            $table->unsignedBigInteger('runner_id');
            $table->foreign('runner_id', 'runner_fk_3056730')->references('id')->on('runners');
            $table->unsignedBigInteger('race_id');
            $table->foreign('race_id', 'race_fk_3056731')->references('id')->on('racings');
        });
    }
}
