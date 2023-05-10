<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait ContactRequestValidatorTrait{


    public function validateCreateContactRequest(Request $request): \Illuminate\Validation\Validator
    {
        $rules = [
            'name' => 'required|string',
            'email' => 'required|email|unique:contacts',
            'phone_number' => 'required|string',
            'address' => 'nullable|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'zip_code' => 'required|string',
            'category_id' => 'required|string|exists:categories,id',
        ];
        return Validator::make($request->all(), $rules,[
            'category_id.exists' => 'The selected category is invalid'
        ]);
    }

    public function validateUpdateContactRequest(Request $request, $id): \Illuminate\Validation\Validator
    {
        $rules = [
            'name' => 'nullable|string',
            'email' => 'nullable|unique:contacts,email,'.$id,
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'country' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'category_id' => 'nullable|string|exists:categories,id',
        ];
        return Validator::make($request->all(), $rules,[
            'category_id.exists' => 'The selected category is invalid'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validateCreateContactProfilePhotoRequest(Request $request): \Illuminate\Validation\Validator
    {
        $rules = [
            'file.*' => 'sometimes|mimes:jpeg,png,jpg',
        ];
        return Validator::make($request->all(), $rules);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validateDeleteContactImage(Request $request): \Illuminate\Validation\Validator
    {
        $rules = [
            'path' => 'required|string',
        ];
        return Validator::make($request->all(), $rules);
    }
}

