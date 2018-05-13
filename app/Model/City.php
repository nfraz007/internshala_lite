<?php 

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'city';
	protected $primaryKey = 'city_id';
	protected $fillable = ["city_name", "status"];
	public $timestamps=false;

	public static function get_name($city_id = ""){
		$city = City::where("city_id", "$city_id")->first();
		if($city) return $city["city_name"];
		else return "";
	}
}