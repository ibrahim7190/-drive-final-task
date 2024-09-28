<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken("myToken")->plainTextToken;

        $response = [
            "message" => " Welcome New User",
            "user" => $user,
            "token" => $token,
        ];
        return response($response, 200);
    }
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email','=',$data['email'])->first();

        if(!$user || !Hash::check($data['password'],$user->password))
        {
            return response("The e-mail address or password you entered was incorrect.");
        }
        $token = $user->createToken("myToken")->plainTextToken;

        $response = [
            "message" => " Welcome New User",
            "user" => $user,
            "token" => $token,
        ];
        return response($response, 200);
    }

    public function logout()
   {
    auth()->user()->tokens()->delete();
    return[
        "message" => "Logged out"
    ];
   }
}
