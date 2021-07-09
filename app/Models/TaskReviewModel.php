<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskReviewModel extends Model
{
    protected $table='task_review_models';
    protected $primaryKey='id';
    protected $fillable=[
        'review_date',
        'task_id',
        'user_id',
        'status',
        'review_type_id',
        'url',
        'created_by',
        'updated_by'
    ];

    public function reviewtype() {
        return $this->belongsTo(ReviewType::class,'review_type_id','review_type_id');
    }
    public function user() {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function reviewStatus() {
        return $this->belongsTo(TaskStatusModel::class,'status','status_id');
    }
}
