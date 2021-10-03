<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpReviewChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_categories_id',
        'checklist',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    /**
     * Link Main Categories
     */
    public function getMainCategory()
    {
        return $this->belongsTo(EmpReviewChecklistMainCategory::class, 'main_categories_id', 'id');
    }
    /**
     * Get Review Checklist
     */
    public static function getReviewChecklist()
    {
        try {
            $data = EmpReviewChecklist::all();
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Add new review checklist
     */
    public static function storeReviewChecklist($data)
    {
        try {
            $currentDateTime = Carbon::now()->toDateTimeString();
            $userId = auth('sanctum')->user()->id;
            $type = $data['request_method'];
            $insertData = [
                'main_categories_id' => $data['review_type'],
                'checklist' => $data['review_name'],
                'updated_by' => $userId,
                'updated_at' => $currentDateTime,
            ];
            if ($type == 'add') {
                $insertData['created_by'] = $userId;
            }
            if ($type == 'update') {
                $status = EmpReviewChecklist::where('id', '=', $data['id'])->update($insertData);
            } else if ($type == 'add') {
                $status = EmpReviewChecklist::create($insertData);
            }
            return [
                'id'=>$status,
                'status'=>true
            ];
        } catch (Exception $e) {
            throw ($e->getMessage());
        }
    }
    /**
     * Delete checklist
     */
    public static function deleteReviewChecklist($data)
    {
        try {
            $status=false;
            $message='Cannot find id';
            if (!empty($data['id'])) {
                $deleteStatus = EmpReviewChecklist::where('id', '=', $data['id'])->delete();
                if ($deleteStatus) {
                    $status=true;
                    $message='Deleted Successfully';
                } else {
                    $message='Not Deleted Successfully';
                }
            }
            return [
                'data'=>$message,
                'status'=>$status
            ];
        } catch (Exception $e) {
            throw ($e->getMessage());
        }
    }
}
