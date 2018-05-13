<?php 

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';
	protected $primaryKey = 'user_id';
	protected $fillable = ["user_type", "first_name", "last_name", "email", "password", "token", "company_name", "website", "company_detail", "created_at", "updated_at", "user_authorize", "user_status"];
	public $timestamps=false;

	public static function get_company_name($user_id = ""){
		$user = User::where("user_id", "$user_id")->first();
		if($user) return $user["company_name"];
		else return "";
	}

	public static function get_company_detail($user_id = ""){
		$user = User::where("user_id", "$user_id")->first();
		if($user) return $user["company_detail"];
		else return "";
	}

	public static function get_website($user_id = ""){
		$user = User::where("user_id", "$user_id")->first();
		if($user) return $user["website"];
		else return "";
	}
}