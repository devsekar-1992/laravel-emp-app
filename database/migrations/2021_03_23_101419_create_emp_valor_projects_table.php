<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpValorProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_valor_projects', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('valor_project_id');
            $table->string('valor_project_identifier',150);
            $table->string('valor_project_name',150);
            $table->unsignedTinyInteger('valor_project_status');
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
        Schema::dropIfExists('emp_valor_projects');
    }
}
