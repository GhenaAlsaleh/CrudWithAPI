<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function showLoginForm(){
        return view("auth.login");
    }
    public function login(Request $request){
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
            $user=Auth::user();
            //$user = User::where('id',$userid)->where('status','Active')->first();
            if($user->status=='Blocked'){
                return back()->with("error", "You are blocked!");
            }
            $request->session()->regenerate();
            return redirect()->route('posts.index');
            
        }
        return back()->with("error", "invalid email or password!");
    }
    public function logout(Request $request){
        Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route("login");
        }
}
