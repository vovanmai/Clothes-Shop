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
		$product_info=Products_info::all();
		$colors=Colors::all();
		$sizes=Sizes::all();
		$paging = new Pagination();
		$count=Products::count();
		$limit = 10;
		if(!isset($_GET['page'])) {
			$current_page = 1;
			$paging->init("products",$current_page, $limit, $count[0]->total_record);
			$products=Products::getAllPagination($current_page,$limit);
			return view('admin/products/index',['products'=>$products,'product_info'=>$product_info ,'paginghtml'=>$paging->html(),'colors'=>$colors,'sizes'=>$sizes]);
		} else {
			$current_page = $_GET['page'];
			$paging->init("products",$current_page, $limit, $count[0]->total_record);
			$products=Products::getAllPagination($current_page,$limit);
			$tbody = '';
			foreach ($products as $item) {
					$id=$item->id;
					$product_info_id=$item->product_info_id;
					$color_id=$item->color_id;
					$size_id=$item->size_id;
					$quantity=$item->quantity;
			$tbody .= 		
			'<tr>
			<td class="text-center">'.$id.'</td>
			<td class="text-center">';
					foreach ($product_info as $key => $item) {
						$id_info=$item->id;
						$name=$item->name;
						if($product_info_id==$id_info){
							$tbody .= $name;
						}
					}
					$tbody .= '</td>
			<td class="text-center">';
				foreach ($colors as $key => $item) {
                    $name=$item->name;
                    if($item->id==$color_id){
                        $tbody.=$name;
                    }
                }
            $tbody.='</td>
			<td class="text-center">';
				foreach ($sizes as $key => $item) {
                    $name=$item->size;
                    if($item->id==$size_id){
                        $tbody.=$name;
                        break;
                    }
                }
			$tbody.='</td>
			<td class="text-center">'.$quantity.'</td>
			<td class="text-center">
				<div class="hidden-sm hidden-xs btn-group">
					<a class="btn btn-xs btn-info" href="/admin/products/edit?id='.$id.'">
						<i class="ace-icon fa fa-pencil bigger-120"></i>
					</a>
					<a class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure to delete ? \');" 
					href="/admin/products/delete?id='.$id.'">
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
	public function destroy()
	{
		$id=$_GET['id'];

		if (empty(Products::checkDeleteConstrain('order_details',$id))) {
			if(Colors::delete($id)){
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