<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use Illuminate\Http\Request;
use App\Models\User;
// 登入使用
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(CreateUser $request)
    {
        $validatedData = $request->validated();
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            // 加密bcrypt
            'password' => bcrypt($validatedData['password']),
        ]);
        $user->save();
        return response('success', 201);
    }

    public function login(Request $request) 
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // 登入失敗
        if(!Auth::attempt($validatedData)) 
        {
            return response('授權失敗', 401);
        }
        // 登入成功
        $user = $request->user();
        // dump($user);
        
        // 建立通行證token
        $tokenResult = $user -> createToken('token');
        $tokenResult ->token->save();
        return response(['token' => $tokenResult->accessToken]);
        // 需使用composer require lcobucci/jwt取得accessToken，解密網https://jwt.io/
        // dump($tokenResult);

    }

    public function logout(Request $request) 
    {
        $request->user()->token()->revoke();
        return response(
            ['message' =>'登出']
        );
    }
    
    // 取得會員資料
    public function user(Request $request)
    {
        return response(
            $request->user()
        );
    }

}
