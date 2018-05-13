<?php 

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'category';
	protected $primaryKey = 'category_id';
	protected $fillable = ["category_name", "status"];
	public $timestamps=false;

	public static function get_name($category_id = ""){
		$category = Category::where("category_id", "$category_id")->first();
		if($category) return $category["category_name"];
		else return "";
	}
}