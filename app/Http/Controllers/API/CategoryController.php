<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CategoryRepository;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllCategories(Request $request): \Illuminate\Http\JsonResponse
    {
        $response = (new CategoryRepository)->getAllCategories();
        return $this->successResponse($response);
    }
}
