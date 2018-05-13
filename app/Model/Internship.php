<?php 

namespace App\Model;

use App\Model\Category;
use App\Model\City;
use App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'internship';
	protected $primaryKey = 'internship_id';
	protected $fillable = ["user_id", "category_id", "city_id", "internship_name", "skills", "internship_detail", "start_date", "duration", "stipend", "created_at", "updated_at", "internship_authorize", "internship_status"];
	public $timestamps=false;

	public static function get_data($id){
		$internship = Internship::where("internship_id", $id)->first();
        $data = array();

        if($internship){
        	$data["internship_id"] = $internship["internship_id"];
        	$data["href_view"] = URL("internship/".base64_encode($data["internship_id"]));
        	$data["href_edit"] = URL("hire/save/".base64_encode($data["internship_id"]));
        	$data["user_id"] = $internship["user_id"];
        	$data["category"] = array("category_id" => $internship["category_id"], "category_name" => Category::get_name($internship["category_id"]));
        	$data["city"] = array("city_id" => $internship["city_id"], "city_name" => City::get_name($internship["city_id"]));
        	$data["internship_name"] = $internship["internship_name"];
        	$data["company_name"] = User::get_company_name($internship["user_id"]);
        	$data["company_detail"] = User::get_company_detail($internship["user_id"]);
        	$data["website"] = User::get_website($internship["user_id"]);
        	$data["skills"] = explode(",", $internship["skills"]);
        	$data["internship_detail"] = $internship["internship_detail"];
        	$data["start_date"] = date("d M'y", strtotime($internship["start_date"]));
        	$data["duration"] = $internship["duration"];
        	$data["stipend"] = $internship["stipend"];
        	$data["created_at"] = date("d M'y", strtotime($internship["created_at"]));
        	$data["updated_at"] = date("d M'y", strtotime($internship["updated_at"]));
        	$data["internship_authorize"] = $internship["internship_authorize"];
        	$data["internship_status"] = $internship["internship_status"];
        }
        return $data;
	}

	public static function get_data_list($filter = array()){
		$sql = Internship::select("internship_id");

		if(isset($filter["internship_id"]) && trim($filter["internship_id"])!=""){
			$sql->where("internship_id", $filter["internship_id"]);
		}

		if(isset($filter["user_id"]) && trim($filter["user_id"])!=""){
			$sql->where("user_id", $filter["user_id"]);
		}

		if(isset($filter["category_id"]) && trim($filter["category_id"])!=""){
			$sql->where("category_id", $filter["category_id"]);
		}

		if(isset($filter["city_id"]) && trim($filter["city_id"])!=""){
			$sql->where("city_id", $filter["city_id"]);
		}

		if(isset($filter["internship_authorize"]) && trim($filter["internship_authorize"])!=""){
			$sql->where("internship_authorize", $filter["internship_authorize"]);
		}

		if(isset($filter["internship_status"]) && trim($filter["internship_status"])!=""){
			$sql->where("internship_status", $filter["internship_status"]);
		}

		if(isset($filter["filter"]) && trim($filter["filter"])!=""){
			switch($filter["filter"]){
				case "all" : break;
				case "active" : $sql->where("internship_authorize", "1")->where("internship_status", "1"); break;
				default : break;
			}
		}
		
		// code for search
		if(isset($filter["search"]) && trim($filter["search"])!=""){
			$search = $filter["search"];
			$search_array = array("internship_name", "skills");

			$sql->where(function($sql) use ($search, $search_array){ 
				$search_keywords = explode(" ", $search);
				foreach($search_keywords as $search_keyword){
					for($i=0;$i<count($search_array);$i++){
						if($i==0) $sql->where($search_array[$i], "like", "%".$search_keyword."%");
						else $sql->orWhere($search_array[$i], "like", "%".$search_keyword."%");
					}
				}
			});
		}

		$sort_array = array("internship_id");
		
		if(isset($filter["sort"]) && trim($filter["sort"])!="" && in_array($filter["sort"], $sort_array)){
			$sort = $filter["sort"];
		}else{
			$sort = "internship_id";
		}

		if(isset($filter["sort_type"]) && trim($filter["sort_type"])!="" && ($filter["sort_type"] == "asc" || $filter["sort_type"] == "ASC")){
			$sort_type = $filter["sort_type"];
		}else{
			$sort_type = "desc";
		}

		$sql->orderBy("$sort", "$sort_type");

		// take the total data
		$total_count = count($sql->get());
		
		if(isset($filter["page"]) && trim($filter["page"])!=""){
			$page = $filter["page"];
		}else{
			$page = 1;
		}

		if(isset($filter["limit"]) && trim($filter["limit"])!=""){
			$limit = ($filter["limit"]<50) ? $filter["limit"] : 50;
		}else{
			$limit = 20;
		}

		$sql->skip(($page-1)*$limit)->take($limit);

		// echo $sql->toSql();die;
		$results = $sql->get();
		$data_count = count($results);
		$total_page = ceil($total_count/$limit);

		$data = array();

		foreach($results as $result){
			$data[] = static::get_data($result["internship_id"]);
		}
		
		return array("total_count" => $total_count, "total_page" => $total_page, "data_count" => $data_count, "page" => $page, "limit" => $limit, "sort" => "$sort", "sort_type" => "$sort_type", "data" => $data);
	}
}