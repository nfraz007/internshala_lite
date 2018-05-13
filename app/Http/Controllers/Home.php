<?php

/*
    @author : Nazish Fraz (nfraz007@gmail.com)
    @date : 13-01-2018
    @description : Home COntroller for home page
*/
    
namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Model\Category;
use App\Model\City;

use App\Http\Controllers\Auth\Login;

use Illuminate\Routing\Controller as BaseController;

class Home extends BaseController
{
    public $datetime;

    public function __construct() {
        $this->datetime=date("Y-m-d H:i:s");
        // $this->middleware("login_check");
    }

    public function index(Request $request){
        $data = array();

        $data["page_title"] = "Home";
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));
        $data["switch"] = (base64_decode($request->session()->get("user_type")) == "1") ? "checked" : "";

        $data["popular_cities"] = City::take(6)->get();
        $data["popular_categories"] = Category::take(6)->get();

    	return view('home', $data);
    }
}