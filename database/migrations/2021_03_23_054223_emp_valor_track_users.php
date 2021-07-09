<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpValorTrackUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_valor_tracker_users', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('valor_user_id');
            $table->string('valor_first_name',150);
            $table->string('valor_last_name',150);
            $table->string('valor_email',150);
            $table->tinyInteger('valor_is_admin');
            $table->string('valor_user_status',50);
            $table->dateTime('sync_on',$precision=0);
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
        Schema::dropIfExists('emp_valor_tracker_users');
    }
}
