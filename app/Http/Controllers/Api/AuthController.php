<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $validateData=$request->validate([
                "name"=>"required|string",
                "email"=>"required|string|email|unique:users,email",
                "password"=>"required|string|confirmed|min:5",
            ]);
            $user=User::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Hash::make($request->password),
            ]);
            $token=$user->creatToken($user->name."-AuthToken")->plainTextToken;
            $Data=[
                "id"=>$user->id,
                "name"=>$user->name,
                "email"=>$user->email,
            ];
            return response()->json(["message"=>"user created successfully","user"=>$Data,"token"=>$token],200);
            
    }
    
    public function login(Request $request){
        $validateData=$request->validate([
                "email"=>"required|string|email",
                "password"=>"required|string",
            ]);
            $user=User::where()->first("email",$request->email);
            if(!$user || !Hash::check($request->password, $user->password)){
                return response()->json(["message"=>"invalid credentials (password or email wrong)"],401);
            }
            $token=$user->creatToken($user->name."-AuthToken")->plainTextToken;
            $Data=[
                "id"=>$user->id,
                "name"=>$user->name,
                "email"=>$user->email,
            ];
            return response()->json(["user"=>$Data,"token"=>$token],200);
            
    }
    public function logout(Request $request){
        auth()->user->tokens()->delete();
        return response()->json(["message"=>"logged out"]);
        }
    
}
