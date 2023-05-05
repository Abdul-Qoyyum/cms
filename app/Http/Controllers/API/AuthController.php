<?php

namespace App\Http\Controllers\API;

use App\Http\Constants\HttpResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Repositories\AuthRepository;
use App\Http\Traits\AuthRequestValidatorTrait;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use ResponseTrait, AuthRequestValidatorTrait;

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = $this->validateRegisterRequest($request);
        if($validator->fails()){
            return $this->errorResponse('Validation Error.', $validator->errors(), HttpResponseCode::BAD_REQUEST);
        }
        try {
            DB::beginTransaction();
            $response = AuthRepository::register($request);
            DB::commit();
            return $this->successResponse($response, HttpResponseCode::CREATED);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->exceptionResponse($e);
        }


    }
}
