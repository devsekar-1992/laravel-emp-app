<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpTaskList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_task_list', function (Blueprint $table) {
            $table->bigIncrements('task_id');
            $table->unsignedBigInteger('task_version_id');
            $table->text('task_name');
            $table->unsignedMediumInteger('valor_task_url_id');
            $table->unsignedInteger('task_assignee_id');
	        $table->char('is_deleted',1);
            $table->unsignedInteger('created_by');
            $table->timestamps();

            $table->foreign('task_version_id')->references('id')->on('emp_task_version')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_task_list');
    }
}
