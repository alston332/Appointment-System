<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppiontmentClientPivotTable extends Migration
{
    public function up()
    {
        Schema::create('appiontment_client', function (Blueprint $table) {
            $table->unsignedInteger('appiontment_id');

            $table->foreign('appiontment_id', 'appiontment_id_fk_489690')->references('id')->on('appiontments')->onDelete('cascade');

            $table->unsignedInteger('client_id');

            $table->foreign('client_id', 'client_id_fk_489690')->references('id')->on('clients')->onDelete('cascade');
        });
    }
}
