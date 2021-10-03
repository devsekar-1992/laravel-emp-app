<?php

namespace App\Models;

use App\Models\TaskCodeReviewModel;
use App\Models\TaskVersionModel;
use App\Models\TaskPseudoCodeReviewModel;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class OpenProjectModel extends Model
{
    use HasFactory;

    /**
     * Sync the open project tasks information for particular status like code submitted, waiting for approval
     *
     * @return array
     */
    public static function syncOpenProjectsTask()
    {
	$sync=0;
	$status=false;
        $openProjectUrl=config('openproject.api_url') . 'projects/' . config('openproject.project_id') . '/work_packages/?pageSize=' . config('openproject.pageSize') . '&filters=[{"status":{"operator":"=","values":["22","34"]}}]';
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . config('openproject.api_key'),
        ])->withoutVerifying()->get($openProjectUrl);
        $responseBody = json_decode($response->body(), true);
        if ($responseBody['count'] != '0') {
            /**
             * Project Version
             */
            $versionInfo['valor_wp_id'] = $responseBody['id'];
            $versionInfo['valor_project_id'] = $responseBody['_embedded']['project']['id'];
            $versionInfo['valor_wp_name'] = $responseBody['name'];
            $isVersionInserted = TaskVersionModel::where('valor_wp_id', '=', $responseBody['id'])->select('id')->get()->toArray();
            if (count($isVersionInserted) > 0) {
                $versionId = $isVersionInserted[0]['id'];
            } else {
                $savedVersionInfo = TaskVersionModel::saveTaskVersion($versionInfo);
                if ($savedVersionInfo['status']) {
                    $versionId = $savedVersionInfo['id'];
                }
            }
            if ($versionId > 0) {
                $current_date_time = Carbon::now()->toDateTimeString();
                foreach ($responseBody['_embedded']['results']['_embedded']['elements'] as $key => $value) {
                    $isTaskExists = Task::where('valor_task_url_id', '=', $value['id'])->where('task_version_id', '=', $versionId)->select('task_id')->get()->toArray();
                    if (count($isTaskExists) == 0) {
                        $taskStatus = explode('/', $value['_links']['status']['href']);
                        $taskAssignee = explode('/', $value['_links']['assignee']['href']);
                        $taskList['task_version_id'] = $versionId;
                        $taskList['task_name'] = $value['subject'];
                        $taskList['valor_task_url_id'] = $value['id'];
                        $taskList['task_assignee_id'] = $taskAssignee['4'];
                        $taskList['is_deleted'] = 'N';
                        $taskList['created_by'] = $whodid;
                        $taskList['created_at'] = $current_date_time;
                        $taskList['updated_at'] = $current_date_time;
                        $taskId = DB::table('emp_task_list')->insertGetId($taskList);
                    } else {
                        $taskId = $isTaskExists[0]['task_id'];
                        $taskStatus = explode('/', $value['_links']['status']['href']);
                    }
                    if ($taskId > 0) {
                        $reviewRequest['task_id'] = $taskId;
                        $reviewRequest['user_id'] = $whodid;
                        $reviewRequest['status'] = '3';
                        $reviewRequest['created_by'] = $whodid;
                        $reviewRequest['created_at'] = $current_date_time;
                        $reviewRequest['updated_at'] = $current_date_time;
                        if ($taskStatus['4'] == '22') {
                            $reviewRequest['review_type']='2';
                        } else if ($taskStatus['4'] == '34') {
                            $reviewRequest['review_type']='1';
                        }
                        $isAnyPendingAgainstTask = TaskReviewModel::where('task_id', '=', $taskId)->where('status', '=', '3')->where('review_type','=',$reviewRequest['review_type'])->count();
                        if ($isAnyPendingAgainstTask == 0) {
                            $result=TaskReviewModel::insert($reviewRequest);
			}
			$sync++;
                    }
                }
		if ($sync > 0) {
			$status = true;
			$message = 'Total ' . $sync . ' users are synced successfully';
		}
		return [
			'status' => $status,
			'msg' => $message,
		];
            }
        }
    }

    /**
     * Sync the open project users information
     *
     * @return array
     */
    public static function syncOpenProjectUsers()
    {
        $sync = 0;
        $status = false;
        $message = 'Not synced either already synced';
        $currentDateTime = Carbon::now()->toDateTimeString();
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . config('openproject.api_key'),
        ])->withoutVerifying()->get(
            config('openproject.api_url') . 'users?pageSize=' . config('openproject.pageSize') . '&filters=[{"group":{"operator":"=","values":["15"]}},{"status":{"operator":"=","values":["active"]}}]'
        );
        $responseBody = json_decode($response->body(), true);
        foreach ($responseBody['_embedded']['elements'] as $key => $value) {
            $isUsersExists = DB::table('emp_valor_tracker_users')->where('valor_user_id', '=', $value['id'])->count();
            $valorInfo['valor_user_id'] = $value['id'];
            $valorInfo['valor_first_name'] = $value['firstName'];
            $valorInfo['valor_last_name'] = $value['lastName'];
            $valorInfo['valor_email'] = $value['email'];
            $valorInfo['valor_is_admin'] = $value['admin'];
            $valorInfo['valor_user_status'] = $value['status'];
            $valorInfo['sync_on'] = $currentDateTime;
            $valorInfo['updated_at'] = $currentDateTime;
            if ($isUsersExists == 0) {
                $valorInfo['created_at'] = $currentDateTime;
                DB::table('emp_valor_tracker_users')->insert($valorInfo);
            } else {
                DB::table('emp_valor_tracker_users')->where('valor_user_id', '=', $value['id'])->update($valorInfo);
            }
            $sync++;
        }
        if ($sync > 0) {
            $status = true;
            $message = 'Total ' . $sync . ' users are synced successfully';
        }
        return [
            'status' => $status,
            'message' => $message,
        ];
    }
}
