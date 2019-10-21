<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppiontmentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('appiontment_user', function (Blueprint $table) {
            $table->unsignedInteger('appiontment_id');

            $table->foreign('appiontment_id', 'appiontment_id_fk_489691')->references('id')->on('appiontments')->onDelete('cascade');

            $table->unsignedInteger('user_id');

            $table->foreign('user_id', 'user_id_fk_489691')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
