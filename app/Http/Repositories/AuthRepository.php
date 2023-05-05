<?php
namespace App\Http\Repositories;

use App\Models\User;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash;

class AuthRepository{
    use ResponseTrait;

    /**
     * Register api
     *
     * @param $request
     * @return array
     */
    public static function register($request): array
    {
        $request->merge([
            'password' => Hash::make($request->post('password'))
        ]);
        $user = User::query()->create($request->all());
        $token =  $user->createToken('MyApp')->plainTextToken;
        return [
            'token' => $token,
            'user' => $user
        ];
    }

}
