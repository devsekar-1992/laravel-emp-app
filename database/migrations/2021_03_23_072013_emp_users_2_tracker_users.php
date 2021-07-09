<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpUsers2TrackerUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_users_2_tracker_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->unsignedMediumInteger('valor_user_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('emp_users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_users_2_tracker_users');
    }
}
