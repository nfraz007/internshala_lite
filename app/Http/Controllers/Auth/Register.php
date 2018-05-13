<?php

/*
    @author : Nazish Fraz (nfraz007@gmail.com)
    @date : 13-01-2018
    @description : register COntroller for home page
*/
    
namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use App\Model\User;

use App\Http\Controllers\Auth\Login;

use Illuminate\Routing\Controller as BaseController;

class Register extends BaseController
{
    public $datetime;

    public function __construct() {
        $this->datetime=date("Y-m-d H:i:s");
    }

    public function student(Request $request){
        $data = array();

        $data["page_title"] = "Register - Student";
        $data["action"] = URL("register/student");
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));
        
        if($request->input("submit")){
            // user has submit the form
            $email = $data["email"] = $request->input("email");
            $password = $request->input("password");
            $first_name = $data["first_name"] = $request->input("first_name");
            $last_name = $data["last_name"] = $request->input("last_name");

            // validating every thing
            $validator=Validator::make($request->all(), [
                'first_name'  => 'required|string|max:64',
                'last_name'   => 'required|string|max:64',
                'email'       => 'required|email|max:64',
                'password'    => 'required|min:6|max:20',
            ]);

            if($validator->fails()){
                return view('register.student', $data)->withErrors($validator);
            }

            $ip=$request->ip();

            $user = User::where("email", $data["email"])->first();
            if($user){
                // user already exist
                $data["status"] = "red-text";
                $data["message"] = "This email is already exist";
            }else{
                // new user. need to add in the database
                $password = sha1(md5($password));
                $user_type = "0";
                $user_id = User::insertGetId([ "user_type" => "$user_type", "first_name" => "$first_name", "last_name" => "$last_name", "email" => "$email", "password" => "$password", "token" => "", "created_at" => $this->datetime, "updated_at" => $this->datetime, "user_authorize" => "1", "user_status" => "1" ]);
                
                Login::login($user_id, $request);

                $data["status"] = "teal-text";
                $data["message"] = "You are successfully register";

                return redirect('home');
            }
        }

    	return view('register.student', $data);
    }

    public function company(Request $request){
        $data = array();

        $data["page_title"] = "Register - Company";
        $data["action"] = URL("register/company");
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));
        
        if($request->input("submit")){
            // user has submit the form
            $email = $data["email"] = $request->input("email");
            $password = $request->input("password");
            $first_name = $data["first_name"] = $request->input("first_name");
            $last_name = $data["last_name"] = $request->input("last_name");
            $company_name = $data["company_name"] = $request->input("company_name");

            // validating every thing
            $validator=Validator::make($request->all(), [
                'first_name'  => 'required|string|max:64',
                'last_name'   => 'required|string|max:64',
                'company_name'=> 'required|string|max:64',
                'email'       => 'required|email|max:64',
                'password'    => 'required|min:6|max:20',
            ]);

            if($validator->fails()){
                return view('register.company', $data)->withErrors($validator);
            }

            $ip=$request->ip();

            $user = User::where("email", $data["email"])->first();
            if($user){
                // user already exist
                $data["status"] = "red-text";
                $data["message"] = "This email is already exist";
            }else{
                // new user. need to add in the database
                $password = sha1(md5($password));
                $user_type = "1";
                $user_id = User::insertGetId([ "user_type" => "$user_type", "first_name" => "$first_name", "last_name" => "$last_name", "email" => "$email", "password" => "$password", "company_name" => "$company_name", "created_at" => $this->datetime, "updated_at" => $this->datetime, "user_authorize" => "1", "user_status" => "1" ]);
                
                Login::login($user_id, $request);

                $data["status"] = "teal-text";
                $data["message"] = "You are successfully register";

                return redirect('home');
            }
        }

        return view('register.company', $data);
    }
}