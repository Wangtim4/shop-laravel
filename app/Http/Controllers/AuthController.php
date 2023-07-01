<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUser;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function signup(CreateUser $request) 
    {
        $validatedData = $request -> validated();
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            // 加密bcrypt
            'password' => bcrypt($validatedData['password']),
        ]);
        $user->save();
        return response('success', 201);
    }
    public function index() {
        return 'auth';
    }
}
