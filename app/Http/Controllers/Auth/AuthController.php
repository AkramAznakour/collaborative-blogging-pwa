<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, App\User, JWTAuth, Hash;

class AuthController extends Controller
{
    

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success'=>false, 'message' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['success'=>false, 'message' => 'could_not_create_token'], 500);
        }

        return response()->json(['success'=>true, 'token'=>$token], 200);
    }

    public function register(Request $request)
    {
                $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(['success'=>true,'token'=>$token],201);
    }

    
    public function index()
    {
        $user = JWTAuth::user();
        return response()->json(['sucess'=>true, 'data'=>$user], 200);
    }

    
}

