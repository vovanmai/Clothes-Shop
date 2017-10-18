<?php 
namespace app\models;
use core\App;
use \PDO;
use app\models\Model;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;

class Products_info extends Model
{
	public static $table="products_info";


	public static function updateActive($id,$active)
	{
		$parameters['active']=$active;
		$parameters['id']=$id;
		$query='UPDATE products_info SET active=? WHERE id=?';
		return App::get('database')->query_excute_params($query,$parameters);
	}
	public static function getHotProduct()
	{
		$query="SELECT * FROM ".static::$table." WHERE view > 100 ORDER BY view";
		return App::get('database')->query_fetch($query);
	}
	public static function getID_Product($id)
	{
		$query="SELECT id FROM products 
		where product_info_id = ".$id;
		return App::get('database')->query_fetch($query);
	}

}


?>