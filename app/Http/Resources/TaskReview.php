<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskReview extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $url=($this->url==null)?'':$this->url;
        return [
            'review_id'=>$this->id,
            'review_date'=>'"'.$this->review_date.'"',
            'task_id'=>$this->task_id,
            'url'=>$url,
            'user_id'=>$this->user_id,
            'review_type'=>$this->reviewtype->review_type,
            'created_by'=>$this->user->first_name.' '.$this->user->last_name,
            'status'=>[
                'status_id'=>$this->reviewStatus->status_id,
                'status'=>$this->reviewStatus->status_name
            ],
            'review_created_at'=>'"'.$this->created_at.'"',
            'review_updated_at'=>'"'.$this->updated_at.'"'
        ];
    }
}
