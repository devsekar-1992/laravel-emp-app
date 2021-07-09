<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpReviewChecklistResource extends JsonResource
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
            'id'=>$this->id,
            'checklist'=>$this->checklist,
            'main_category'=>$this->getMainCategory->main_categories,
            'review_type'=>$this->getMainCategory->getTaskReviewType->review_type,
            'created_at'=>$this->created_at
        ];
    }
}
