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

    	return view('account', $data);
    }
}