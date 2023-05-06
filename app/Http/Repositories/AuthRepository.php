<?php
namespace App\Http\Repositories;

use App\Http\Constants\Common;
use App\Models\User;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

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
        $token =  $user->createToken(Common::AUTH_TOKEN)->plainTextToken;
        return [
            'token' => $token,
            'user' => $user
        ];
    }

    /**
     * @throws \Exception
     */
    public static function login(Request $request){
        if(Auth::attempt([
            'email' => $request->post('email'),
            'password' => $request->post('password')
        ])){
            $user = Auth::user();
            $token =  $user->createToken(Common::AUTH_TOKEN)->plainTextToken;
            return [
              'user' => $user,
              'token' => $token
            ];
        }
        else{
            (new self)->throwException('Invalid Credentials');
        }
    }

}
