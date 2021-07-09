<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Exceptions\EmpValidationException;

class UserRequest extends FormRequest
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
            'first_name'=>'required',
            'last_name'=>'required',
            'primary_number'=>'required|digits:10|numeric',
            'email'=>'required|unique:emp_users|email',
            'password'=>'required',
            'department_id'=>'required'
        ];
    }
    /**
     * Get the validation messages that apply to the request
     *
     * @return array
     */
    public function messages()
    {
        return [
            'first_name.required'=>'First Name is required'
        ];
    }
    /**
     * Throw the exception via Customize Exception Handler
     *
     * @return Exceptions
     */
    protected function failedValidation(Validator $validate) {
        throw new EmpValidationException($validate);
    }
}
