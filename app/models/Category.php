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
	public static function getProductInfoByGender($id)
	{
		$query="SELECT * FROM cat INNER JOIN products_info ON cat.id=products_info.cat_id WHERE gender=$id";
		return App::get('database')->query_fetch($query);
	}

	
}
?>