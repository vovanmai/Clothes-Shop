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
		$query="SELECT * FROM ".static::$table." WHERE active=1 AND view > 100 ORDER BY view";
		return App::get('database')->query_fetch($query);
	}
	public static function getID_Product($id)
	{
		$query="SELECT id FROM products 
		where product_info_id = ".$id;
		return App::get('database')->query_fetch($query);
	}

	public static function getProductInfoByCat($id)
	{
		$query="SELECT * FROM cat INNER JOIN products_info ON cat.id=products_info.cat_id WHERE cat.active=1 AND products_info.cat_id=$id";
		return App::get('database')->query_fetch($query);
	} 

	public static function getProductsSearch($current_page, $limit, $style, $price)
	{
		$start = ($current_page - 1) * $limit;
		$query = "SELECT * from products_info where cat_id =? and products_info.active=1";
		switch ($price) {
			case 0:
				$query.=' and price between 0 and 200';
				break;
			case 1:
				$query.=' and price between 200 and 500';
				break;
			case 2:
				$query.=' and price between 500 and 800';
				break;
			case 3:
				$query.=' and price > 800';
				break;
		}
		 $arr=array(
		             'style'=>$style,
		 );
		$query.=' limit ?, ?';
		$arr['start']=$start;
		$arr['limit']=$limit;
		return App::get('database')->query_fetch_params($query,$arr);
	}

	public static function search($style, $price)
	{
		$query = "SELECT * from products_info where cat_id =? and products_info.active=1";
		switch ($price) {
			case 0:
				$query.=' and price between 0 and 200';
				break;
			case 1:
				$query.=' and price between 200 and 500';
				break;
			case 2:
				$query.=' and price between 500 and 800';
				break;
			case 3:
				$query.=' and price > 800';
				break;
		}
		 $arr=array(
        	'style'=>$style,
        );
		return App::get('database')->query_fetch_params($query,$arr);

	}

	

}


?>