<?php 
namespace app\models;
use core\App;
use \PDO;
use app\models\Model;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;

class Products extends Model
{
	public static $table="products";

	public static function getAllPagination($current_page, $limit)
	{
		$start = ($current_page - 1) * $limit;
		$query='select * from products limit ?, ?';
		return App::get('database')->query_fetch_params($query,array('start'=>$start,'limit'=>$limit));
	}
	
	public static function count()
	{
		$query='select count(*) as total_record from products_info';
		return App::get('database')->query_fetch($query);
	}
}


?>