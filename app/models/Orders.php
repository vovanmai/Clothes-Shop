<?php 
namespace app\models;
use core\App;
use \PDO;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;;

class Orders extends Model
{
	public static $table="orders";

	public static function allOrdersPagination($current_page, $limit)
	{
		$start = ($current_page - 1) * $limit;
		$query='select *,orders.id as id_order,users.id as id_user, payment.id as id_payment, orders.id as id_order from '.static::$table.' inner join users on '.static::$table.'.user_id=users.id inner join payment on payment.id='.static::$table.'.payment_id limit ?, ?';
		return App::get('database')->query_fetch_params($query,array('start'=>$start,'limit'=>$limit));
	}

	public static function allSearch($current_page, $limit,$search_User)
	{
		$start = ($current_page - 1) * $limit;

		$fullname=$search_User['fullname'];
		$paid=$search_User['paid'];
		$shipped=$search_User['shipped'];
		$status=$search_User['status'];
		$date_order=$search_User['date_order'];
		$payment_id=$search_User['payment'];
		$query='select *,orders.id as id_order, users.id as id_user from '.static::$table.' inner join users on users.id=orders.user_id inner join payment on orders.payment_id=payment.id where 1'; 
		$params=array();
		if($fullname!='')
		{
			$query.=' and fullname like concat("%", ?, "%")';
			$params['fullname']=$fullname;
		}
		if($paid!=-1)
		{
			$query.=' and paid =?';
			$params['paid']=$paid;
		}
		if($shipped!=-1)
		{
			$query.=' and shipped = ?';
			$params['shipped']=$shipped;
		}
		if($status!=-1)
		{
			$query.=' and status = ?';
			$params['status']=$status;
		}
		if($payment_id!=-1)
		{
			$query.=' and payment_id = ?';
			$params['payment_id']=$payment_id;
		}
		if($date_order!='')
		{
			$query.=' and date_order = ?';
			$params['date_order']=$date_order;
		}
		
		$query.=' limit ?, ?';
		$params['start']=$start;
		$params['limit']=$limit;
		return App::get('database')->query_fetch_params($query,$params);
	}

	
	public static function search($search_Order)
	{
		$fullname=$search_Order['fullname'];
		$paid=$search_Order['paid'];
		$shipped=$search_Order['shipped'];
		$status=$search_Order['status'];
		$date_order=$search_Order['date_order'];
		$payment_id=$search_Order['payment'];
		$query='select *, orders.id as id_order,users.id as id_user from '.static::$table.' inner join users on users.id=orders.user_id inner join payment on orders.payment_id=payment.id where 1'; 
		$params=array();
		if($fullname!='')
		{
			$query.=' and fullname like concat("%", ?, "%")';
			$params['fullname']=$fullname;
		}
		if($paid!=-1)
		{
			$query.=' and paid =?';
			$params['paid']=$paid;
		}
		if($shipped!=-1)
		{
			$query.=' and shipped = ?';
			$params['shipped']=$shipped;
		}
		if($status!=-1)
		{
			$query.=' and status = ?';
			$params['status']=$status;
		}
		if($payment_id!=-1)
		{
			$query.=' and payment_id = ?';
			$params['payment_id']=$payment_id;
		}
		if($date_order!='')
		{
			$query.=' and date_order = ?';
			$params['date_order']=date("Y-m-d H:i:s", strtotime($date_order));
		}

		return App::get('database')->query_fetch_params($query,$params);
	}

	public static function auth($id)
	{
		if ( Session::getSession('user') !=null) {
			$user=Session::getSession('user');
			if($user[0]->level==1||$user[0]->id==$id)
			{
				return true;
			}else
			{
				return false;
			}
		}

	}

	public static function updateActivePaid($paid,$id)
	{
		$query="UPDATE ".static::$table." SET paid=? WHERE id=?";
		return App::get('database')->query_excute_params($query,array('paid'=>$paid,'id'=>$id));	
	}

	public static function updateActiveShipped($shipped,$id)
	{
		$query="UPDATE ".static::$table." SET shipped=? WHERE id=?";
		return App::get('database')->query_excute_params($query,array('shipped'=>$shipped,'id'=>$id));	
	}

	public static function updateStatus($status,$id)
	{
		$query="UPDATE ".static::$table." SET status=? WHERE id=?";
		return App::get('database')->query_excute_params($query,array('status'=>$status,'id'=>$id));	
	}

	public static function deleteOrderDetail($order_id)
	{
		$query="DELETE FROM order_details WHERE order_id=?";
		return App::get('database')->query_excute_params($query,array('order_id'=>$order_id));
	}

	public static function detail($order_id)
	{
		$query="SELECT *, products_info.name as name_product,products.quantity as quantity_product, products.id as id_product, products_info.id as id_product_info, color.id as id_color, size.id as id_size, color.name as name_color, size.size as name_size FROM order_details inner join products on order_details.product_id=products.id inner join products_info on products.product_info_id=products_info.id
		inner join color on products.color_id=color.id 
		inner join size on products.size_id=size.id  WHERE order_id=?";
		return App::get('database')->query_fetch_params($query,array('order_id'=>$order_id));
	}

	public static function getEmail($id)
	{
		$query = "SELECT email FROM users INNER JOIN orders ON users.id = orders.user_id WHERE orders.user_id IN (SELECT user_id FROM orders WHERE id =?)  " ;
		return App::get('database')->query_fetch_params($query,array('id'=>$id));
	}
}
?>