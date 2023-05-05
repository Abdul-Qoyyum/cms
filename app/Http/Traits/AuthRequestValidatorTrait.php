<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait AuthRequestValidatorTrait{

    /**
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validateRegisterRequest(Request $request): \Illuminate\Validation\Validator
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
        return Validator::make($request->all(), $rules);
    }
}
