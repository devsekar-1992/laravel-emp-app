<?php

namespace App\Exceptions;
use App\Http\Traits\ResponseTrait;

use Exception;

class NotRouteFoundException extends Exception
{
    use ResponseTrait;
    /**
     * Render to screen
     */
    public function render()
    {
        return $this->sendNotFoundResponse();
    }

}
