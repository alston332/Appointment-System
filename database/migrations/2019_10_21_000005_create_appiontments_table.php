<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppiontmentsTable extends Migration
{
    public function up()
    {
        Schema::create('appiontments', function (Blueprint $table) {
            $table->increments('id');

            $table->datetime('start_time');

            $table->datetime('finish_time');

            $table->longText('comments')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
