<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;

class EmpValidationException extends Exception
{
    protected $validator;

    protected $code=422;

    function __construct(Validator $validator) {
        $this->validator=$validator;
    }
    public function render() {
        return response()->json(
            [
                'error_msg'=>'Form Validator Errors',
                'message'=>$this->validator->errors()
            ],
            $this->code
        );
    }
}
