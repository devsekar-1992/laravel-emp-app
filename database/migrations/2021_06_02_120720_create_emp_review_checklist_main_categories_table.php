<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpReviewChecklistMainCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_review_checklist_main_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('review_type_id');
            $table->string('main_categories',100);
            $table->text('description');
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
        Schema::dropIfExists('emp_review_checklist_main_categories');
    }
}
