<?php

namespace App\Models;

use App\Exceptions\FailedQueryException;
use App\Models\TaskReviewModel;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

use Illuminate\Support\Facades\Log;

class Task extends Model
{

    /**
     * Table
     */
    protected $table = 'emp_task_list';
    protected $primaryKey = 'task_id';

    /**
     * Store task information
     *
     * @return array
     */
    public static function saveTask($request)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        $request['created_at'] = $current_date_time;
        $request['updated_at'] = $current_date_time;
        $insertedId = DB::table('emp_task_list')->insertGetId($request);
        return [
            'status' => 200,
            'id' => $insertedId,
        ];
    }

    /**
     * Get Task Information
     *
     * @return array
     */
    public static function getTaskList()
    {
        $resultSet = DB::table('emp_task_list as task')
            ->join('emp_task_version as task_version', 'task_version.id', '=', 'task_version_id')
            ->join('emp_users_2_tracker_users as usr_2_track_user', 'usr_2_track_user.valor_user_id', '=', 'task.task_assignee_id')
            ->join('emp_users', 'emp_users.id', '=', 'usr_2_track_user.user_id')
            ->select('task.task_id', 'task.task_name', 'task.valor_task_url_id', 'task.created_at', 'emp_users.first_name', 'emp_users.last_name', 'task_version.valor_wp_name')
            ->get();
        return [
            'data' => $resultSet,
        ];
    }

    /**
     * Get task pseudo code review
     *
     * @return array
     */
    public function taskpseudocodereviewmodel()
    {
        return $this->hasMany(TaskPseudoCodeReviewModel::class, 'task_id');
    }

    /**
     * Get task code review
     *
     * @return model
     */
    public function taskreviewmodel()
    {
        return $this->hasMany(TaskReviewModel::class, 'task_id', 'task_id');
    }
    /**
     * Get User Information for tash
     *
     * @return model
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    /**
     * Get User Updated By
     *
     * @return model
     */
    public function userUpdatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    /**
     * Get Task Assignee
     *
     * @return model
     */
    public function userTaskAssignee()
    {
        return $this->belongsTo(ValorTrackerUserModel::class, 'task_assignee_id', 'valor_user_id');
    }
    /**
     * Get Task Version Information
     *
     * @return model
     */
    public function taskVersionInfo()
    {
        return $this->belongsTo(TaskVersionModel::class, 'task_version_id', 'id');
    }
    public static function getTaskReviewDetails(Array $id)
    {
        return TaskReviewModel::where('id','=',$id['id'])->get();
    }
    /**
     * Save Task Review Model
     *
     * $return array
     */
    public static function saveTaskReviewModel($taskItems)
    {
        Log::info("Task Init Request");
        Log::debug($taskItems);
        try {
            $current_date_time = Carbon::now()->toDateTimeString();
            $userId=auth('sanctum')->user()->id;
            $items = [
                'review_date' => $taskItems['review_date'],
                'status' => $taskItems['status'],
                'updated_by' => $userId,
                'user_id' => $taskItems['user_id'],
                'review_type_id' => $taskItems['review_type_id'],
                'url' => $taskItems['url'],
            ];
            if ($taskItems['request_method'] == 'update') {
                TaskReviewModel::where('id', '=', $taskItems['task_review_id'])->update(
                    $items
                );
            } else {
                $items['created_by'] = $userId;
                $items['created_at'] = $current_date_time;
                $items['updated_at'] = $current_date_time;
                $items['task_id']=$taskItems['task_id'];
                Log::info("Creation task");
                Log::debug($items);
                TaskReviewModel::create($items);
            }
            return true;
        } catch (QueryException $queryException) {
            $code = 0;
            print_r($queryException->getMessage());
            throw new FailedQueryException('Query Failed due to ' . $queryException->getMessage(), $code, $queryException);
        }
    }
}
