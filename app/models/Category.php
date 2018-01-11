<?php 
namespace app\models;
use core\App;
use \PDO;
use app\models\Model;
use core\Session;
use core\database\QueryBuilder;	
use core\database\Connection;

class Category extends Model
{
	public static $table="cat";

	public static function getCatByGender($gender)
	{
		$query="SELECT * FROM cat WHERE gender=$gender and active=1";
		return App::get('database')->query_fetch($query);
	}

	public static function getGenderByStyle($id)
	{
		$query="SELECT * FROM cat WHERE id=$id";
		return App::get('database')->query_fetch($query);
	}

	public static function getProductInfoByGender($id)
	{
		$query="SELECT * FROM cat INNER JOIN products_info ON cat.id=products_info.cat_id WHERE gender=$id";
		return App::get('database')->query_fetch($query);
	}

	public static function checkCat($parameters,$id)
	{
		$arr = array(
			'name' => $parameters['name'],
			'gender'=>$parameters['gender'],
			'id'=>$id
			);
		$query="SELECT * FROM cat WHERE name=? AND gender=? AND id!=?";
		return App::get('database')->query_fetch_params($query,$arr);
	}


	public static function checkCatAdd($parameters)
	{
		$query="SELECT * FROM cat WHERE name=? AND gender=?";
		return App::get('database')->query_fetch_params($query,$parameters);
	}


	
}
?>