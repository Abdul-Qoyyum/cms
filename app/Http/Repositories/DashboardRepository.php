<?php

namespace App\Http\Repositories;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardRepository{

    public static function dashboardAnalytics(Request $request){
        $categories = Category::all();
        $response = [];
        foreach ($categories as $category){
            $response[$category->name] = Contact::query()
                ->where('category_id',$category->id)
                ->where('user_id', Auth::id())->count();
        }
        return $response;
    }
}
