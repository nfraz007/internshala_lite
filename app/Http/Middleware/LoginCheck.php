<?php

/*
    @author : Nazish Fraz (nfraz007@gmail.com)
    @date : 13-01-2018
    @description : login check middleware
*/

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginCheck
{
    public function handle($request, Closure $next, $guard = null)
    {
        $user_id = base64_decode($request->session()->get("user_id"));
        $user_type = base64_decode($request->session()->get("user_type"));
        $first_name = base64_decode($request->session()->get("first_name"));
        $last_name = base64_decode($request->session()->get("last_name"));
        $token = $request->session()->get("token");
        
        $user = User::where("user_id", "$user_id")->first();
        if($user){
            if($user_type == $user["user_type"] && $first_name == $user["first_name"] && $last_name == $user["last_name"] && $token == $user["token"]){
                // user is logged in
                return $next($request);
            }else{
                return redirect("login");
            }
        }else{
            return redirect("home");
        }
    }
}