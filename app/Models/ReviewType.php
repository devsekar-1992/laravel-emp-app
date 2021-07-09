<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewType extends Model
{
    use HasFactory;

    /**
     * Table
     */
    protected $table='emp_review_type';
    protected $primaryKey='review_type_id';
    protected $hidden = [
        'laravel_through_key'
     ];
}
