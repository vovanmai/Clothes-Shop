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
		$link='/admin/products?p={page}';
		$product_info=Products_info::all();
		$colors=Colors::all();
		$sizes=Sizes::all();
		$paging = new Pagination();
		$count=Products::count();
		$limit = 10;
		$current_page = isset($_GET['p']) ? $_GET['p'] : 1;
		$paging->init("",$link,$current_page, $limit, $count[0]->total_record);
		$products=Products::getAllPagination($current_page,$limit);
		return view('admin/products/index',['products'=>$products,'product_info'=>$product_info ,
		'paging'=>$paging->gethtml(),'colors'=>$colors,'sizes'=>$sizes]);
	}
	public function destroy()
	{
		$id=$_GET['id'];

		if (empty(Products::checkDeleteConstrain('order_details',$id))) {
			if(Products::delete($id)){
				Session::createSession('msg','Deleted Successfully!');
				return redirect('admin/products');
			} 
		} else {
			Session::createSession('msg','Error Constrain with Products!');
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
		$ar_product_check = array(
			'product_info_id' => $product_info_id,
			'color_id' => $color_id,
			'size_id' => $size_id
			);
		$product_check=Products::checkExistProduct($ar_product_check);
		if($product_check!=null){
			Session::createSession('msg','Product is existed. Please check!');
			return redirect('admin/products/add');
		}
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

	public function edit($id)
	{
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