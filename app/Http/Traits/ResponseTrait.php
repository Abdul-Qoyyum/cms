<?php
namespace App\Http\Traits;

use App\Http\Constants\HttpResponseCode;
use Illuminate\Http\JsonResponse;

trait ResponseTrait{
    /**
     * success response method.
     *
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse($data, int $code = HttpResponseCode::OK): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => true,
            'data'    => $data,
        ];
        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse($error, $errorMessages = [], int $code = HttpResponseCode::NOT_FOUND): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }


    public function exceptionResponse(\Exception $exception): JsonResponse
    {
        $payload = [
            'status' => 'error',
            'message' => $exception->getMessage()
        ];
        $code = $exception->getCode();
        if($code == 0 || $code > 20000){
            $code = HttpResponseCode::INTERNAL_SERVER_ERROR;
        }
        return new JsonResponse($payload, $code);
    }


    /**
     * @throws \Exception
     */
    public function throwException($errorMessage, $errorCode = HttpResponseCode::BAD_REQUEST)
    {
        throw new \Exception($errorMessage, $errorCode);
    }


}
