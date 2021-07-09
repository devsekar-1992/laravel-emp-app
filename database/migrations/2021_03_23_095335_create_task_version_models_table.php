<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskVersionModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_task_version', function (Blueprint $table) {
            $table->id();
            $table->tinyMediumInteger('valor_wp_id');
            $table->unsignedSmallInteger('valor_project_id');
            $table->string('valor_wp_name',100);
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
        Schema::dropIfExists('emp_task_version');
    }
}
