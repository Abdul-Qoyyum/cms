<?php

namespace App\Http\Controllers\API;

use App\Http\Constants\HttpResponseCode;
use App\Http\Controllers\Controller;
use App\Http\Repositories\DashboardRepository;
use App\Http\Traits\ResponseTrait;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use ResponseTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dashboardAnalytics(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $response = DashboardRepository::dashboardAnalytics($request);
            return $this->successResponse($response);
        }catch (\Exception $e){
            return $this->exceptionResponse($e);
        }
    }
}
