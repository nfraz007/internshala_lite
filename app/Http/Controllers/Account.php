<?php

/*
    @author : Nazish Fraz (nfraz007@gmail.com)
    @date : 02-06-2018
    @description : Account Controller for home page
*/
    
namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Model\User;

use App\Http\Controllers\Auth\Login;

use Illuminate\Routing\Controller as BaseController;

class Account extends BaseController
{
    public $datetime;

    public function __construct() {
        $this->datetime=date("Y-m-d H:i:s");
        $this->middleware("login_check");
    }

    public function index(Request $request){
        $data = array();

        $data["page_title"] = "Account";
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));
        $data["switch"] = (base64_decode($request->session()->get("user_type")) == "1") ? "checked" : "";

        $user_id = base64_decode($request->session()->get("user_id"));
        $data["user"] = User::where("user_id", $user_id)->first();

        $data["action"] = URL("account");

        if($request->input("submit")){
            // user has submit the form
            $data["first_name"] = $request->input("first_name");
            $data["last_name"] = $request->input("last_name");
            $data["website"] = $request->input("website");
            

            // validating every thing
            $validator=Validator::make($request->all(), [
                'first_name' => 'required|string|max:50',
                'last_name' => 'required|string|max:50',
                'website' => 'required|url|max:500',
            ]);

            if($validator->fails()){
                return view('account', $data)->withErrors($validator);
            }

            // update
            User::where("user_id", "$user_id")->update([ "first_name" => $data["first_name"], "last_name" => $data["last_name"], "website" => $data["website"], "updated_at" => $this->datetime ]);
            
            $data["status"] = "teal-text";
            $data["message"] = "You are successfully updated your profile.";
        }

    	return view('account', $data);
    }
}