<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskReviewEdit extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'task_review_id'=>$this->id,
            'task_id'=>$this->task_id,
            'review_date'=>$this->review_date,
            'user_id'=>$this->user_id,
            'review_type_id'=>$this->review_type_id,
            'status'=>$this->status,
            'url'=>$this->url,
            'request_method'=>'update'
        ];
    }
}
