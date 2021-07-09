<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TaskPseudoCodeReviewModel extends Model
{
    use HasFactory;
    protected $primaryKey='pc_id';
    protected $foreignKey='task_id';
    /**
     * Table
     */
    protected $table='emp_pseudo_code_review';

    /**
     * Add code review for given task id
     */
    public static function addPseudoCodeReview($reviewRequest) {
        DB::table('emp_pseudo_code_review')->insert($reviewRequest);
    }


}
