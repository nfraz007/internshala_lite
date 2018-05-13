<?php

/*
    @author : Nazish Fraz (nfraz007@gmail.com)
    @date : 13-01-2018
    @description : login COntroller for home page
*/
    
namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Model\User;

use App\Http\Controllers\Auth\Login;

use Illuminate\Routing\Controller as BaseController;

class Login extends BaseController
{
    public $datetime;

    public function __construct() {
        $this->datetime=date("Y-m-d H:i:s");
    }

    public function index(Request $request){
        $data = array();

        $data["page_title"] = "Login";
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));

        $data["action"] = URL("login");
        
        if($request->input("submit")){
            // user has submit the form
            $email = $data["email"] = $request->input("email");
            $password = sha1(md5($request->input("password")));

            // validating every thing
            $validator=Validator::make($request->all(), [
                'email'       => 'required|email|max:64',
                'password'    => 'required|min:6|max:20',
            ]);

            if($validator->fails()){
                return view('login', $data)->withErrors($validator);
            }

            $ip=$request->ip();

            $user = User::where("email", $data["email"])->first();
            if($user){
                // user login exist
                if($password == $user["password"]){
                    Login::login($user["user_id"], $request);
                    return redirect("home");
                }else{
                    // incorrect credential
                    $data["status"] = "red-text";
                    $data["message"] = "Password is incorrect";
                }
            }else{
                // incorrect credential
                $data["status"] = "red-text";
                $data["message"] = "Email is incorrect";
            }
        }

    	return view('login', $data);
    }

    public static function login($user_id = "", $request = ""){
        $user = User::where("user_id", "$user_id")->first();
        if($user){
            $token = sha1(md5(rand(100000,999999)));
            User::where("user_id", "$user_id")->update([ "token" => "$token" ]);

            $request->session()->put('token', "$token");
            $request->session()->put("user_type", base64_encode($user["user_type"]));
            $request->session()->put("user_id", base64_encode($user_id));
            $request->session()->put("first_name", base64_encode($user["first_name"]));
            $request->session()->put("last_name", base64_encode($user["last_name"]));
        }
    }

    public static function logout(Request $request){
        $user_id = base64_decode($request->session()->get("user_id"));
        $user = User::where("user_id", "$user_id")->first();
        if($user){
            User::where("user_id", "$user_id")->update([ "token" => "" ]);

            $request->session()->forget('token');
            $request->session()->forget("user_type");
            $request->session()->forget("user_id");
            $request->session()->forget("first_name");
            $request->session()->forget("last_name");

            $request->session()->flush();
        }
        return redirect("home");
    }

    public static function is_login($request = ""){
        $user_id = base64_decode($request->session()->get("user_id"));
        $user_type = base64_decode($request->session()->get("user_type"));
        $token = $request->session()->get("token");

        $user = User::where("user_id", "$user_id")->first();
        if($user){
            if($token == $user["token"] && $user_type == $user["user_type"]){
                // user is logged in
                if($user_type == "0"){
                    return 1;
                }else{
                    return 2;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
}