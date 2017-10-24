<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use app\models\Products_info;
use app\models\Products;
use app\models\Colors;
use app\models\Size;
use app\models\Sizes;
use app\models\Category;
use core\Pagination;


class AdminProductsController
{
	 
	public function index()
	{	
		$link_full='/admin/products?p={page}';
		$limit = 10;
		$count=Products::count();
		$current_page = isset($_GET['p']) ? $_GET['p'] : 1;
   		$paging = new Pagination();
		$paging->init($current_page, $limit, $link_full, $count[0]->total_record);
		$products=Products::getAllPagination($current_page,$limit);
		$product_info=Products_info::all();
		$colors=Colors::all();	
		$sizes=Sizes::all();	
		return view('admin/products/index',['products'=>$products,'product_info'=>$product_info ,'paginghtml'=>$paging->html(),'colors'=>$colors,'sizes'=>$sizes]);
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
		$product=Products::find('id',$id);
		if($product==null){
			return redirect('admin/products');
		}
		$product_info=Products_info::all();
		$colors=Colors::all();
		$size=Size::all();
		return view('admin/products/edit',['product'=>$product,'product_info'=>$product_info,'colors'=>$colors,'size'=>$size]);
	}

	public function update()
	{
		$id=$_POST['id'];
		$product_info_id=$_POST['product_info_id_edit'];
		$color_id=$_POST['product_color'];
		$size_id=$_POST['product_size'];
		$quantity=$_POST['quantity'];
		$product = array(
			'product_info_id' => $product_info_id,
			'color_id' => $color_id,
			'size_id' => $size_id,
			'quantity' => $quantity
			 );
		if(Products::update($product,$id)){
			Session::createSession('msg','Updated Successfully !');
			return redirect('admin/products');
		}
	}
	
}
?>