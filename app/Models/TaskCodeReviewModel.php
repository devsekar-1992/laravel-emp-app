<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TaskCodeReviewModel extends Model
{
    use HasFactory;

    /**
     * Table
     */
    protected $table='emp_code_review';

    /**
     * Add code review for given task id
     */
    public static function addCodeReview($reviewRequest) {
        DB::table('emp_code_review')->insert($reviewRequest);
    }
}
