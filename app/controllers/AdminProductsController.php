<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use app\models\Products_info;
use app\models\Products;
use app\models\Colors;
use app\models\Size;
use app\models\Category;
use core\Pagination;


class AdminProductsController
{
	 
	public function index()
	{	
		$link_full='/admin/products?p={page}';
		$count=Products::count();
		$pagination = Pagination::pagination($count[0]->total_record,$link_full);
		$paginghtml = $pagination['paginghtml'];
		$limit = $pagination['config']['limit'];
		$current_page = $pagination['config']['current_page'];
		$products=Products::getAllPagination($current_page,$limit);	
		$product_info=Products_info::all();
		return view('admin/products/index',['products'=>$products,'product_info'=>$product_info ,'paginghtml'=>$paginghtml]);

	}
	public function destroy()
	{
		$id=$_GET['id'];
		if(Products::delete($id)){
			Session::createSession('msg','Deleted Successfully !');
			return redirect('admin/products');
		}
	}

	public function add()
	{
		$product_info=Products_info::all();
		$colors=Colors::all();
		$size=Size::all();
		return view('admin/products/add',['product_info'=>$product_info,'size'=>$size,'colors'=>$colors]);
	}

	public function store()
	{
		$product_info_id=$_POST['product_info_id_add'];
		$color_id=$_POST['products_color_add'];
		$size_id=$_POST['products_size_add'];
		$quantity=$_POST['quantity'];
		$product = array(
			'product_info_id' => $product_info_id,
			'color_id' => $color_id,
			'size_id' => $size_id,
			'quantity' => $quantity
			 );
		if(Products::insert($product)){
			Session::createSession('msg','Inserted Successfully !');
			return redirect('admin/products');
		}
	}

	public function edit()
	{
		$id=$_GET['id'];
		$product=Products::find($id);
		$product_info=Products_info::all();
		return view('admin/products/edit',['product'=>$product,'product_info'=>$product_info]);
	}
	
}
?>