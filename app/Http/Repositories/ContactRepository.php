<?php
namespace App\Http\Repositories;

use App\Http\Resources\ContactResource;
use App\Http\Traits\PaginationHelperTrait;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactRepository{
    use PaginationHelperTrait;

    /**
     * @param Request $request
     * @return array
     */
    public function getContacts(Request $request): array
    {
        $params = $this->getPaginationParams($request);
        $contactsQuery = Contact::query()
            ->with(['user','category'])
            ->where('user_id', Auth::id());

        if($params['searchString']){
            $contactsQuery->where(function ($q) use ($params){
                $q->where('name','LIKE',"%$params[searchString]%")
                    ->orWhere('email','LIKE',"%$params[searchString]%");
            });
        }

        if($params['categoryId'] && $params['categoryId'] !== "Sort By"){
            $contactsQuery->where('category_id',$params['categoryId']);
        }

        $totalRecords = $contactsQuery->count();
        $offSet = ($params['skip'] - 1) * $params['recordsPerPage'];
        $noOfPages = ceil($totalRecords / $params['recordsPerPage']);

        $contacts = $contactsQuery
            ->orderBy($params['orderBy'], $params['direction'])
            ->skip($offSet)
            ->take($params['recordsPerPage'])
            ->get();


        return [
            'data' => ContactResource::collection($contacts),
            'noOfPages' => $noOfPages,
            'recordsPerPage' => $params['recordsPerPage'],
            'page' => $params['skip'],
            'orderBy' => $params['orderBy'],
            'direction' => $params['direction'],
            'search' => $params['searchString'],
        ];

    }
}
