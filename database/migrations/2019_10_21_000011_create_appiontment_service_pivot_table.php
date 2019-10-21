<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppiontmentServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('appiontment_service', function (Blueprint $table) {
            $table->unsignedInteger('appiontment_id');

            $table->foreign('appiontment_id', 'appiontment_id_fk_489759')->references('id')->on('appiontments')->onDelete('cascade');

            $table->unsignedInteger('service_id');

            $table->foreign('service_id', 'service_id_fk_489759')->references('id')->on('services')->onDelete('cascade');
        });
    }
}
