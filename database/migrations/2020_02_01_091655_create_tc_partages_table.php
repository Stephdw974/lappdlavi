<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTcPartagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tc_partages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tc_compte_id');
            $table->string('name');
            $table->float('amount');
            $table->string('payedBy');
            $table->string('payedFor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tc_partages');
    }
}
