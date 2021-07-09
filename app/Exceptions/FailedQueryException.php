<?php

namespace App\Exceptions;

use Exception;

class FailedQueryException extends Exception
{
    public function __construct($message, $code = '', $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    /**
     * Report the exception
     *
     * @return void
     */
    public function report()
    {
        \Log::debug('Error in query');
    }
    /**
     * Render the response
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response()->json([
            'message' => 'Failed to save',
        ],
            500
        );
    }

}
