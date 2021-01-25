<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRunnersResultsTable extends Migration
{
    public function up()
    {
        Schema::table('runners_results', function (Blueprint $table) {
            $table->unsignedBigInteger('runner_id');
            $table->foreign('runner_id', 'runner_fk_3056692')->references('id')->on('runners');
            $table->unsignedBigInteger('race_id');
            $table->foreign('race_id', 'race_fk_3056693')->references('id')->on('racings');
        });
    }
}
