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
	public static function getSizes($id)
	{
		$query = "SELECT size FROM size where size.id in (select size_id 
		from products where product_info_id = ".$id.")";
		return App::get('database')->query_fetch($query);

	}
	public static function getColors($id)
	{
		$query = "SELECT name FROM color where color.id in (select color_id
		from products where product_info_id = ".$id.")";
		return App::get('database')->query_fetch($query);

	} 

	public static function getProductsSearch($gender,$style,$price)
	{
		$query = "SELECT *, products_info.id as id_products_info, products_info.name as name_product FROM products_info inner join cat on products_info.cat_id=cat.id where cat.gender= ? and cat_id=? and products_info.active=1 ";
		switch ($price) {
			case 0:
				$query.=' and price between 0 and 200000';
				break;
			case 1:
				$query.=' and price between 200000 and 350000';
				break;
			case 2:
				$query.=' and price between 350000 and 500000';
				break;
			case 3:
				$query.=' and price between 500000 and 700000';
				break;
			case 4:
				$query.=' and price between 700000 and 1000000';
				break;
		}
		 $arr=array(
        	'gender'=>$gender,
        	'style'=>$style,
        );
		
		return App::get('database')->query_fetch_params($query,$arr);

	}

}


?>