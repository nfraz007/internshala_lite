<?php

/*
    @author : Nazish Fraz (nfraz007@gmail.com)
    @date : 13-01-2018
    @description : Intership COntroller for home page
*/
    
namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Model\Internship;
use App\Model\City;
use App\Model\Category;

use App\Http\Controllers\Auth\Login;

use Illuminate\Routing\Controller as BaseController;

class InternshipHome extends BaseController
{
    public $datetime;

    public function __construct() {
        $this->datetime=date("Y-m-d H:i:s");
    }

    public function index(Request $request){
        $data = array();

        $data["page_title"] = "Internship";
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));
        $data["switch"] = (base64_decode($request->session()->get("user_type")) == "1") ? "checked" : "";

        $request["category_id"] = $data["filter_category"] = $request->input("filter_category");
        $request["city_id"] = $data["filter_city"] = $request->input("filter_city");
        $request["search"] = $data["filter_search"] = $request->input("filter_search");
        $request["filter"] = "active";

        $internships = Internship::get_data_list($request);
        $data["total_count"] = $internships["total_count"];
        $data["total_page"] = $internships["total_page"];
        $data["data_count"] = $internships["data_count"];
        $data["page"] = $internships["page"];
        $data["limit"] = $internships["limit"];
        $data["sort"] = $internships["sort"];
        $data["sort_type"] = $internships["sort_type"];
        $data["internships"] = $internships["data"];

        $data["cities"] = City::get();
        $data["categories"] = Category::get();
        $data["href"] = URL("internship");

    	return view('internship_list', $data);
    }

    public function view(Request $request, $id = ""){
        $data = array();

        $data["page_title"] = "Internship - View";
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));
        $data["switch"] = (base64_decode($request->session()->get("user_type")) == "1") ? "checked" : "";

        $internship_id = base64_decode($id);
        $internship = Internship::where("internship_id", "$internship_id")->first();
        if($internship){
            // internship exist
            $data["internship"] = Internship::get_data($internship_id);
            $data["internship_title"] = $data["internship"]["internship_name"]." Internship in ".$data["internship"]["city"]["city_name"]." at ".$data["internship"]["company_name"];

            return view("internship_view", $data);
        }else{
            return redirect("internship");
        }
    }

    public function hire(Request $request){
        $this->middleware("login_check");
        
        $data = array();

        $data["page_title"] = "Hire - Intern";
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));
        $data["switch"] = (base64_decode($request->session()->get("user_type")) == "1") ? "checked" : "";

        $request["category_id"] = $data["filter_category"] = $request->input("filter_category");
        $request["city_id"] = $data["filter_city"] = $request->input("filter_city");
        $request["search"] = $data["filter_search"] = $request->input("filter_search");
        $request["user_id"] = base64_decode($request->session()->get("user_id"));
        $request["filter"] = "active";

        $internships = Internship::get_data_list($request);
        $data["total_count"] = $internships["total_count"];
        $data["total_page"] = $internships["total_page"];
        $data["data_count"] = $internships["data_count"];
        $data["page"] = $internships["page"];
        $data["limit"] = $internships["limit"];
        $data["sort"] = $internships["sort"];
        $data["sort_type"] = $internships["sort_type"];
        $data["internships"] = $internships["data"];

        $data["cities"] = City::get();
        $data["categories"] = Category::get();
        $data["href"] = URL("hire");

        return view('hire', $data);
    }

    public function hire_save(Request $request, $internship_id = ""){
        $this->middleware("login_check");
        
        $data = array();

        $data["page_title"] = "Hire - Intern";
        $data["is_login"] = Login::is_login($request);
        $data["username"] = base64_decode($request->session()->get("first_name"));
        $data["switch"] = (base64_decode($request->session()->get("user_type")) == "1") ? "checked" : "";

        $user_id = $request["user_id"] = base64_decode($request->session()->get("user_id"));
        
        $internship = Internship::where("internship_id", "$internship_id")->first();

        $data["action"] = ($internship_id) ? $internship["href_edit"] : URL("hire/save");
        $data["cities"] = City::get();
        $data["categories"] = Category::get();

        $data["category_id"] = (isset($internship) && isset($internship["category_id"]) && trim($internship["category_id"])!="") ? $internship["category_id"] : "";
        $data["city_id"] = (isset($internship) && isset($internship["city_id"]) && trim($internship["city_id"])!="") ? $internship["city_id"] : "";
        $data["internship_name"] = (isset($internship) && isset($internship["internship_name"]) && trim($internship["internship_name"])!="") ? $internship["internship_name"] : "";
        $data["skills"] = (isset($internship) && isset($internship["skills"]) && trim($internship["skills"])!="") ? $internship["skills"] : "";
        $data["internship_detail"] = (isset($internship) && isset($internship["internship_detail"]) && trim($internship["internship_detail"])!="") ? $internship["internship_detail"] : "";
        $data["start_date"] = (isset($internship) && isset($internship["start_date"]) && trim($internship["start_date"])!="") ? date("j F, Y", strtotime($internship["start_date"])) : "";
        $data["duration"] = (isset($internship) && isset($internship["duration"]) && trim($internship["duration"])!="") ? $internship["duration"] : "";
        $data["stipend"] = (isset($internship) && isset($internship["stipend"]) && trim($internship["stipend"])!="") ? $internship["stipend"] : "";
        
        if($request->input("submit")){
            // user has submit the form
            $category_id = $data["category_id"] = $request->input("category_id");
            $city_id = $data["city_id"] = $request->input("city_id");
            $internship_name = $data["internship_name"] = $request->input("internship_name");
            $skills = $data["skills"] = $request->input("skills");
            $internship_detail = $data["internship_detail"] = $request->input("internship_detail");
            $start_date = $data["start_date"] = date("Y-m-d H:i:s", strtotime($request->input("start_date")));
            $duration = $data["duration"] = $request->input("duration");
            $stipend = $data["stipend"] = $request->input("stipend");
            $internship_authorize = "1";
            $internship_status = "1";
            

            // validating every thing
            $validator=Validator::make($request->all(), [
                'category_id' => 'required|integer|min:1',
                'city_id' => 'required|integer|min:1',
                'internship_name' => 'required|string|max:512',
                'skills' => 'required|string|max:1000',
                'internship_detail' => 'required|string',
                'start_date' => 'required',
                'duration' => 'required|integer|min:1',
                'stipend' => 'required|string|max:64',
            ]);

            if($validator->fails()){
                return view('hire_form', $data)->withErrors($validator);
            }

            $ip=$request->ip();
            
            if($internship_id){
                // update
                Internship::where("internship_id", "$internship_id")->update([ "category_id" => "$category_id", "city_id" => "$city_id", "internship_name" => "$internship_name", "skills" => "$skills", "internship_detail" => "$internship_detail", "start_date" => "$start_date", "duration" => "$duration", "stipend" => "$stipend", "updated_at" => $this->datetime ]);
                return redirect("internship/".base64_encode($internship_id));
            }else{
                // insert
                Internship::insert([ "user_id" => "$user_id", "category_id" => "$category_id", "city_id" => "$city_id", "internship_name" => "$internship_name", "skills" => "$skills", "internship_detail" => "$internship_detail", "start_date" => "$start_date", "duration" => "$duration", "stipend" => "$stipend", "created_at" => $this->datetime, "updated_at" => $this->datetime, "internship_authorize" => "$internship_authorize", "internship_status" => "$internship_status" ]);
                return redirect("hire");
            }
        }

        return view('hire_form', $data);
    }

    public function hire_edit(Request $request, $id = ""){
        $internship_id = base64_decode($id);
        $user_id = base64_decode($request->session()->get("user_id"));
        $internship = Internship::where("internship_id", "$internship_id")->first();
        if($internship){
            if($internship["user_id"] == "$user_id"){
                return $this->hire_save($request, $internship_id);
            }else{
                return redirect("hire");
            }
        }else{
            return redirect("hire");;
        }
    }
}