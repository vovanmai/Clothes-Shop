<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use app\models\ProductInfo;
use app\models\Category;
use core\Pagination;


class AdminProductInfoController
{
	public function index()
	{	
		$cat=Category::all('cat');
		$product_info=ProductInfo::all('product_info');
		return view('admin/product_info/index',['product_info'=>$product_info,'cat'=>$cat]);
	}
	public function add()
	{
		return view('admin/product_info/add');
	}

}
?>