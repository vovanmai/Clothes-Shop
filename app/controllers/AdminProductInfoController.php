<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use app\models\Products_info;
use app\models\Category;
use core\Pagination;


class AdminProductInfoController
{
	 
	public function index()
	{	
		$link_full='/admin/product_info?p={page}';
		$count=Products_info::count();
		$pagination = Pagination::pagination($count[0]->total_record,$link_full);
		$paginghtml = $pagination['paginghtml'];
		$limit = $pagination['config']['limit'];
		$current_page = $pagination['config']['current_page'];
		$products_info=Products_info::getAllPagination($current_page,$limit);	
		$cats=Category::all();
		return view('admin/product_info/index',['products_info'=>$products_info,'cats'=>$cats ,'paginghtml'=>$paginghtml]);	
	}
	public function add()
	{
		$cat=Category::all();
		return view('admin/product_info/add',['cat'=>$cat]);
	}
	public function store()
	{
		$name=$_POST['name'];
		$categoy=$_POST['categoy'];
		$image=$_FILES['image']['name'];
		$price=$_POST['price'];
		$description=$_POST['description'];
		$detail=$_POST['detail'];
		if($image!=''){
			$tmp_name=$_FILES['image']['tmp_name'];
			$tmp=explode('.',$image);
			$file_end=end($tmp);
			$new_file_name='product_info-'.$name.'-'.time().'.'.$file_end;
			$pathUpload=$_SERVER['DOCUMENT_ROOT'].'/public/upload/product_info/'.$new_file_name;
			$uploadAction=move_uploaded_file($tmp_name, $pathUpload);

			$products_info= array(
				'name' => $name, 
				'cat_id' => $categoy, 
				'image' => $new_file_name, 
				'price' => $price, 
				'preview_text' => $description, 
				'detail_text' => $detail, 
				);
			if(Products_info::insert($products_info)){
				return redirect('admin/product_info');
			}
		}	
	}


	public function destroy()
	{
		$id=$_GET['id'];
		if(Products_info::delete($id)){
			Session::createSession('msg','Deleted Successfully !');
			return redirect('admin/product_info');
		}
	}

	public function edit()
	{
		$id=$_GET['id'];
		$product_info=Products_info::find($id);
		$cats=Category::all();
		return view('admin/product_info/edit',['product_info'=>$product_info,'cats'=>$cats]);
	}

	public function update()
	{
		$id=$_POST['id'];

		$name=$_POST['name'];
		$cat_id=$_POST['categoy'];
		$image=$_FILES['image']['name'];
		$price=$_POST['price'];
		$preview_text=$_POST['description'];
		$detail_text=$_POST['detail'];
		$updated_product_info=array(
			'name' => $name, 
			'cat_id' => $cat_id,  
			'price' => $price, 
			'preview_text' => $preview_text, 
			'detail_text' => $detail_text, 
			);
		if($image==''){
			if(Products_info::update($id,$updated_product_info)){
				Session::createSession('msg','Updated Successfully !');
				return redirect('admin/product_info');
			}
		}else{
			$product_info=Products_info::find($id);
			$tmp_name=$_FILES['image']['tmp_name'];
			$tmp=explode('.',$image);
			$file_end=end($tmp);
			$new_file_name='product_info-'.$name.'-'.time().'.'.$file_end;
			$pathUpload=$_SERVER['DOCUMENT_ROOT'].'/public/upload/product_info/'.$new_file_name;
			$uploadAction=move_uploaded_file($tmp_name, $pathUpload);

			if($product_info[0]->image!=''){
				unlink($_SERVER['DOCUMENT_ROOT'].'/public/upload/product_info/'.$product_info[0]->image);
			}
			$updated_product_info['image']=$new_file_name;
			if(Products_info::update($id,$updated_product_info)){
				Session::createSession('msg','Updated Successfully !');
				return redirect('admin/product_info');
			}
		}
	}

	public function changeProductInfoActive()
	{
		$id=$_GET['id'];
		$product_info=Products_info::find($id)[0];
		if($product_info->active==1){
			if(Products_info::updateActive($id,0)){
				echo '<img src="/public/admin/assets/images/deactive.gif" alt="">';
			}
		}else{
			if(Products_info::updateActive($id,1)){
				echo '<img src="/public/admin/assets/images/active.gif" alt="">';
			}
		}
	}

}
?>