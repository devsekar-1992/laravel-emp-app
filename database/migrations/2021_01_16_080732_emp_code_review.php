<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpCodeReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_code_review', function (Blueprint $table) {
            $table->bigIncrements('cr_id');
            $table->unsignedInteger('task_id');
            $table->date('rc_date');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('status');
            $table->text('git_url');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
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
        Schema::dropIfExists('emp_code_review');
    }
}
