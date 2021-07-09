<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\EmpValidationException;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'task_name'=>'required',
            'valor_task_url'=>'required',
            'task_assignee_id'=>'required',
            'created_by'=>'required'
        ];
    }

    /**
     * Set the validation message that apply to the request
     *
     * @return array
     */
    public function messages() {
        return [
            'task_name.required'=>'Please give a task name',
            'valor_task_url.required'=>'Please give a task url',
            'task_assignee_id.required'=>'Please give task assignee name',
            'created_by.required'=>'Please give a created user'
        ];
    }

    /**
     * Return the failed validation to exception
     */
    protected function failedValidation(Validator $validate) {
        throw new EmpValidationException($validate);
    }
}
