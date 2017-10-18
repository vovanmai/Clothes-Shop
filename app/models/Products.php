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

	public static function getColor($product_info_id)
	  {
	        $query = "SELECT DISTINCT color.* from color INNER JOIN products ON color.id =products.color_id WHERE products.product_info_id = ? ";
	        return App::get('database')->query_fetch_params($query,array('product_info_id'=>$product_info_id));

	  }

	  public static function getSize($product_info_id)
	  {
	        $query = "SELECT DISTINCT size.* from size INNER JOIN products ON size.id =products.size_id WHERE products.product_info_id = ? ";
	        return App::get('database')->query_fetch_params($query,array('product_info_id'=>$product_info_id));

	  }

	  public static function getProduct($product_info_id,$size_id,$color_id)
	  {
	        $query = "SELECT * from products WHERE product_info_id = ? AND size_id=? AND color_id= ?";
	        return App::get('database')->query_fetch_params($query,array('product_info_id'=>$product_info_id,'size_id'=>$size_id,'color_id'=>$color_id));

	  }

	  public static function getAllCart($id) {
	    $query ="SELECT products_info.name as namesp,products_info.price as price ,color.name as color,size.size  as size ,products_info.image as image FROM products INNER JOIN products_info ON products.product_info_id = products_info.id INNER JOIN color ON products.color_id = color.id INNER JOIN size ON products.size_id = size.id WHERE products.id=? ";

	     return App::get('database')->query_fetch_params($query,array('products.id'=>$id));
	  }
	   
	//get dia chi ip 
	public static function getRealIPAddress(){  
	    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
	        //check ip from share internet
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
	        //to check ip is pass from proxy
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }else{
	        $ip = $_SERVER['REMOTE_ADDR'];
	    }
	     
	    $tmp = explode(".",$ip);
	    $cart = "cart-";
	    foreach($tmp as $val){
	        $cart.=$val;
	    }
	    return $cart;
	      
	}
}


?>