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
        try {
            $response = (new ContactRepository)->getContacts($request);
            return $this->successResponse($response);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->exceptionResponse($e);
        }
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

    public function getContact(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $response = ContactRepository::getContact($request, $id);
            return $this->successResponse($response);
        }catch (\Exception $e){
            return $this->exceptionResponse($e);
        }
    }

    public function updateContact(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $validator = $this->validateUpdateContactRequest($request, $id);
        if($validator->fails()){
            return $this->errorResponse('Validation Error.', $validator->errors(), HttpResponseCode::BAD_REQUEST);
        }
        try {
            DB::beginTransaction();
            $response = ContactRepository::updateContact($request, $id);
            DB::commit();
            return $this->successResponse($response, HttpResponseCode::CREATED);
        }catch (\Exception $e){
            DB::rollBack();
            return $this->exceptionResponse($e);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createContactImage(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = $this->validateCreateContactProfilePhotoRequest($request);
        if($validator->fails()){
            return $this->errorResponse('Validation Error.', $validator->errors(), HttpResponseCode::BAD_REQUEST);
        }
        try {
            $response = ContactRepository::createContactImage($request);
            return $this->successResponse($response, HttpResponseCode::CREATED);
        }catch (\Exception $e){
            return $this->exceptionResponse($e);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateContactImage(Request $request, $contact_id): \Illuminate\Http\JsonResponse
    {
        $validator = $this->validateUpdateContactProfilePhotoRequest($request);
        if($validator->fails()){
            return $this->errorResponse('Validation Error.', $validator->errors(), HttpResponseCode::BAD_REQUEST);
        }
        try {
            $response = ContactRepository::updateContactImage($request, $contact_id);
            return $this->successResponse($response, HttpResponseCode::CREATED);
        }catch (\Exception $e){
            return $this->exceptionResponse($e);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteContactImage(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = $this->validateDeleteContactImage($request);
        if($validator->fails()){
            return $this->errorResponse('Validation Error.', $validator->errors(), HttpResponseCode::BAD_REQUEST);
        }
        try {
            $response = ContactRepository::deleteContactImage($request);
            return $this->successResponse($response);
        }catch (\Exception $e){
            return $this->exceptionResponse($e);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteContact(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        try {
            $response = ContactRepository::deleteContact($request, $id);
            return $this->successResponse($response);
        }catch (\Exception $e){
            return $this->exceptionResponse($e);
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendContactExport(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $response = ContactRepository::sendContactExport($request);
            return $this->successResponse($response);
        }catch (\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
}
