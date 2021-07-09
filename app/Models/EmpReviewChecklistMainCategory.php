<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpReviewChecklistMainCategory extends Model
{
    use HasFactory;

    protected $table='emp_review_checklist_main_categories';

    public function getTaskReviewType() {
        return $this->belongsTo(ReviewType::class,'review_type_id','review_type_id');
    }
}
