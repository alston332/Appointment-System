<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->integer('phone');

            $table->string('email')->unique();

            $table->string('gender');

            $table->string('vehicle')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
