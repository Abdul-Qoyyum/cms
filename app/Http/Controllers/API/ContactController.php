<?php

namespace App\Http\Controllers\API;

use App\Http\Constants\HttpResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Repositories\ContactRepository;
use App\Http\Traits\PaginationHelperTrait;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use PaginationHelperTrait, ResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getContacts(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = (new ContactRepository)->getContacts($request);
        return $this->successResponse($response, HttpResponseCode::OK);
    }
}
