<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_record', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('movement_id');
            $table->float('value');
            $table->dateTime('date');
        });

        Schema::table('personal_record', function($table) {
            $table->foreign('user_id', 'personal_record_fk0')->references('id')->on('user');
            $table->foreign('movement_id', 'personal_record_fk1')->references('id')->on('movement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_record');
    }
}
