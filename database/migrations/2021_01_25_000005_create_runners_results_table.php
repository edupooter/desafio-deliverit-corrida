<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRunnersResultsTable extends Migration
{
    public function up()
    {
        Schema::create('runners_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('start_time');
            $table->time('finish_time');
            $table->timestamps();
        });
    }
}
