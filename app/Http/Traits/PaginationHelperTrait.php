<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait PaginationHelperTrait{

    /**
     * @param Request $request
     * @return array
     */
    public function getPaginationParams(Request $request): array
    {
        $searchString = !empty($request->query('search')) ? $request->query('search') : '';
        $recordsPerPage = empty($request->query('recordsPerPage')) ? 10 : (int)$request->query('recordsPerPage');
        $direction = $request->query('direction');
        $orderBy = $request->query('orderBy');
        $skip = empty($request->query('page')) ? 1 : (int)$request->query('page');
        $categoryId = !empty($request->query('category_id')) ? $request->query('category_id') : '';
        $offSet = ($skip - 1) * $recordsPerPage;

        return [
            'searchString' => $searchString,
            'recordsPerPage' => $recordsPerPage,
            'direction' => $direction,
            'orderBy' => $orderBy,
            'skip' => $skip,
            'offset' => $offSet,
            'categoryId' => $categoryId,
        ];
    }
}
