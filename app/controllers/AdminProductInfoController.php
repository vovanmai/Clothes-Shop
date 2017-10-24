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
		if(!isset($_GET['page'])) {
			$limit = 10;
			$count=Products_info::count();
			$current_page = 1;
			$paging = new Pagination();
			$paging->init("product_info", $current_page, $limit, $count[0]->total_record);
			$products_info=Products_info::allPagination($current_page,$limit);
			$cats=Category::all();	
			return view('admin/product_info/index',['products_info'=>$products_info, 'paginghtml'=>$paging->html(),'cats'=>$cats]);
		} else {
			$current_page = $_GET['page'];
			$limit = 10;
			$count=Products_info::count();
			$paging = new Pagination();
			$paging->init("product_info", $current_page, $limit, $count[0]->total_record);
			$cats=Category::all();
			$products_info=Products_info::allPagination($current_page,$limit);
			$tbody = '';  
			foreach ($products_info as $item) {
				$id=$item->id;
				$image=$item->image;
				$name=$item->name;
				$cat_id=$item->cat_id;
				$preview_text=$item->preview_text;
				$price=$item->price;
				$active=$item->active;
				$tbody .= '   
		<tr>
			<td class="text-center">'.$id.'</td>
			<td class="text-center">
			  <img class="avatar-index" src="/public/upload/product_info/'.$image.'" alt="">
			</td>
			<td class="text-center">'.$name.'</td>
			<td class="text-center">';
					foreach ($cats as $value) {
						if($value->id==$cat_id){
							$tbody .= $value->name;
							break;
						}
					}
					$tbody .= '</td>
			<td class="text-center">'.$preview_text.'</td>
			<td class="text-center">
				'.number_format($price).' VNĐ
			</td>
			<td class="text-center">
				<a href="javascript:void(0)" onclick="chageActiveProductInfo('.$id.')" class="product_info_active" id="'.$id.'">
					<img src="/public/admin/assets/images/'; 
					if($active==1){
						$tbody .= 'active.gif';
					}else{
						$tbody .= 'deactive.gif';
					}
					$tbody .= '" alt=""></a></td>
			<td class="text-center">
				<div class="hidden-sm hidden-xs btn-group">
					<a class="btn btn-xs btn-info" href="/admin/product_info/edit?id='.$id.'">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</a>
					<a class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure to delete ? \');" href="/admin/product_info/delete?id='.$id.'">
						<i class="ace-icon fa fa-trash-o bigger-120"></i>
					</a>
				</div>
			</td>
		</tr>';
		 }
		 $paging_html =  $paging->html();
		 echo json_encode(array(
			 "tbody" => $tbody, 
			"paging" => $paging_html));
		}
	}
	public function add()
	{
		$cat=Category::all();
		return view('admin/product_info/add',['cat'=>$cat]);
	}
	public function store()
	{
		$name=$_POST['name'];
		$category=$_POST['category'];
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
				'cat_id' => $category, 
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
		$product_info=Products_info::find('id',$id);
		if($product_info==null){
			return redirect('admin/product_info');
		}
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
			if(Products_info::update($updated_product_info,$id)){
				Session::createSession('msg','Updated Successfully !');
				return redirect('admin/product_info');
			}
		}else{
			$product_info=Products_info::find('id',$id);
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
			if(Products_info::update($updated_product_info,$id)){
				Session::createSession('msg','Updated Successfully !');
				return redirect('admin/product_info');
			}
		}
	}

	public function changeProductInfoActive()
	{
		$id=$_GET['id'];
		$product_info=Products_info::find('id',$id)[0];
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