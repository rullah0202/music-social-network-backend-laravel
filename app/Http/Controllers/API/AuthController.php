<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request){
        try {

            $user = User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);
    
            $token = $user->createToken('user_token')->plainTextToken;
    
            return response()->json([
                'user' =>$user,
                'token' =>$token,
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' =>$e->getMessage(),
                'message' =>'Something went wrong in AuthController.register'
            ]);
        }
    }

    public function login(LoginRequest $request){
        try {

            $user = User::where('email','=', $request->input('email'))->firstOrFail();

            if(Hash::check($request->input('password'), $user->password)){

                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json([
                    'user' =>$user,
                    'token' =>$token,
                ],200);

            }
    
            return response()->json([
                'error' =>'Something went wrong in Login'
            ]);
    

        } catch (\Exception $e) {
            return response()->json([
                'error' =>$e->getMessage(),
                'message' =>'Something went wrong in AuthController.Login'
            ]);
        }
    }

    public function logout(LogoutRequest $request){
        try {

            $user = User::findOrFail($request->input('user_id'));

            // if(!Hash::check($request->input('password'), $user->password)){
            //     return response()->json([
            //         'error' =>'Something went wrong in Login'
            //     ]);
            // }
    
            $user->tokens()->delete();
    
            return response()->json('User Logged Out',200);
        } catch (\Exception $e) {
            return response()->json([
                'error' =>$e->getMessage(),
                'message' =>'Something went wrong in AuthController.Logout'
            ]);
        }
    }
}
