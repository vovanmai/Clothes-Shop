<?php 
namespace app\models;
use core\App;
use \PDO;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;;

class Order_details extends Model
{
	public static $table="order_details";

	public static function getOrderDetailByIdOrder($order_id)
	{
		$query="SELECT * FROM order_details WHERE order_id=?";
		return App::get('database')->query_fetch_params($query,array('order_id'=>$order_id));
	}
}
?>