<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->only('email', 'password', 'name'), [
            'name'=> 'required|string',
            'email' => 'required|string',
            'password' => 'required|string|min:5|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'success',
        ],200);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->only('email', 'password'), [
            'email'=> 'required|string',
            'password' => 'required|string|min:5|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }
        $data = $request->all();
        $user = User::where('email', $data['email'])->first();
        if($user == null){
            return response()->json([
                'message' => 'Неправильная почта',
            ],203);
        }
        if(!Hash::check($data['password'], $user->password)){
            return response()->json([
               "Неправильный пароль" ,
            ],401);
        }
        else{
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ],200);
        }
    }
    public function getUserInfo(){
        $user = Auth::user();
        $user_info = User::where('id', $user->id)->first();
        return response()->json($user_info,200);

    }
    public function getUserInfoById($id){
        $user_info = User::where('id', $id)->first();
        return response()->json($user_info,200);

    }
    
}
