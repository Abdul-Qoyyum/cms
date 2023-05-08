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
            'category_id' => 'required|numeric|exists:categories,id',
        ];
        return Validator::make($request->all(), $rules,[
            'category_id.exists' => 'The selected category is invalid'
        ]);
    }

}
