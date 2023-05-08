<?php

namespace App\Http\Controllers\API;

use App\Http\Constants\HttpResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Repositories\ContactRepository;
use App\Http\Traits\ContactRequestValidatorTrait;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    use ResponseTrait, ContactRequestValidatorTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getContacts(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = (new ContactRepository)->getContacts($request);
        return $this->successResponse($response);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createContact(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = $this->validateCreateContactRequest($request);
        if($validator->fails()){
            return $this->errorResponse('Validation Error.', $validator->errors(), HttpResponseCode::BAD_REQUEST);
        }
        try {
            DB::beginTransaction();
            $response = ContactRepository::createContact($request);
            DB::commit();
            return $this->successResponse($response, HttpResponseCode::CREATED);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->exceptionResponse($e);
        }
    }
}
