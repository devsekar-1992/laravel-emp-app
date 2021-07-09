<?php
 namespace App\Http\Traits;
 /**
  * Reusable Response Traits
  */
 trait ResponseTrait
 {
     /**
      * Content Type
      */
      protected $contentType;
      /**
       * Constructor
       */
      public function __construct() {
          $this->contentType = 'application/json';
      }
     /**
      * Send custom data message
      *
      * @param $statusCode
      * @param $message
      * @return \Illuminate\Http\JsonResponse
      */
      public function sendCustomMessage($statusCode, $message)
      {
          return response()->json(
              [
                  'message'=>$message
              ],
              $statusCode
            )->header('Content-Type',$this->contentType);
      }

    /**
     * Send this response when api user provide fields that doesn't exist in our application
     *
     * @param $errors
     * @return mixed
     */
    public function sendUnknownFieldResponse($errors)
    {
        return response()->json((['status' => 400, 'unknown_fields' => $errors]), 400);
    }

    /**
     * Send this response when api user provide filter that doesn't exist in our application
     *
     * @param $errors
     * @return mixed
     */
    public function sendInvalidFilterResponse($errors)
    {
        return response()->json((['status' => 400, 'invalid_filters' => $errors]), 400);
    }

    /**
     * Send this response when api user provide incorrect data type for the field
     *
     * @param $errors
     * @return mixed
     */
    public function sendInvalidFieldResponse($errors)
    {
        return response()->json((['status' => 400, 'invalid_fields' => $errors]), 400);
    }

    /**
     * Send this response when a api user try access a resource that they don't belong
     *
     * @return string
     */
    public function sendForbiddenResponse()
    {
        return response()->json(['status' => 403, 'message' => 'Forbidden'], 403);
    }

    /**
     * Send 404 not found response
     *
     * @param string $message
     * @return string
     */
    public function sendNotFoundResponse($message = '')
    {
        if ($message === '') {
            $message = 'The requested resource was not found';
        }

        return response()->json(['status' => 404, 'message' => $message], 404);
    }

    /**
     * Send empty data response
     *
     * @return string
     */
    public function sendEmptyDataResponse()
    {
        return response()->json(['data' => new \StdClass()]);
    }
    /**
     * Send Success Response
     *
     * @param $statusCode
     * @param $data
     * @return  \Illuminate\Http\JsonResponse
     */
    public function sendSuccessResponse($statusCode, $data) {
        return response()->json(
            [
                'data'=>$data
            ],
            $statusCode
        )->header('Content-Type',$this->contentType);
    }

 }
