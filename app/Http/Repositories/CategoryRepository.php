<?php

namespace App\Http\Repositories;

use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryRepository{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllCategories(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CategoryResource::collection(Category::all());
    }
}
