<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TaskReview;

class TaskResourceCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'task_name'=>$this->task_name,
            'task_created_by'=>$this->user->first_name.' '.$this->user->last_name,
            'task_created_at'=>'"'.$this->created_at.'"',
            'task_assignee_details'=>[
                'name'=>$this->userTaskAssignee->valor_first_name.' '.$this->userTaskAssignee->valor_last_name,
                'id'=>$this->task_assignee_id
            ],
            'task_details'=>[
                'task_version'=>'"'.$this->taskVersionInfo->valor_wp_name.'"',
                'task_url'=>'"'.config('openproject.task_url_path').''.$this->taskVersionInfo->projectInfo->valor_project_identifier.'/'.$this->valor_task_url_id.'"',
                'task_project'=>$this->taskVersionInfo->projectInfo->valor_project_name
            ],
            'task_review'=>TaskReview::collection($this->taskreviewmodel)
        ];
    }
}
