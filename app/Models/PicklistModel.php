<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Users;
use App\Models\TaskStatusModel;

class PicklistModel extends Model
{
    use HasFactory;

    /**
     * Get Active Users List
     *
     * @return array
     */
    public static function getActiveUsers() {
        $status=false;
        $userList=User::all(DB::raw("CONCAT(first_name,' ',last_name) as full_name"),"id")->toArray();
        if(count($userList)>0) {
            $status=true;
        }
        return [
            'status'=>$status,
            'userList'=>$userList
        ];
    }
    /**
     * Get Review Checklist Main Categories
     *
     * @return array
     */
    public static function getChecklistMainCategories(){
        $status=false;
        $checklistMainCategories=EmpReviewChecklistMainCategory::all()->toArray();
        if(count($checklistMainCategories)>0) {
            $status=true;
        }
        return [
            'status'=>$status,
            'checklistMainCategories'=>$checklistMainCategories
        ];
    }
    /**
     * Get Task Status List
     *
     * @return array
     */
    public static function getTaskStatus() {
        $status=false;
        $statusList=TaskStatusModel::all()->toArray();
        if(count($statusList)>0) {
            $status=true;
        }
        return [
            'status'=>$status,
            'statusList'=>$statusList
        ];
    }

    /**
     * Get Review Status List
     *
     * @return array
     */
    public static function getReviewStatus() {
        $status=false;
        $reviewStatusList=ReviewType::all()->toArray();
        if(count($reviewStatusList)>0) {
            $status=true;
        }
        return [
            'status'=>$status,
            'reviewStatusList'=>$reviewStatusList
        ];
    }
}
