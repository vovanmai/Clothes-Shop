<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Orders;
use app\models\Payment;
use core\Pagination;

class OrdersController
{
	function __construct() {
		checkExist();
	}
	public function index()
	{
		$payments=Payment::all();
		$count=Orders::count();
		$limit = 10;
		$paging = new Pagination();
		if(!isset($_GET['page'])) {
			$current_page = 1;
			
			$paging->init("orders", $current_page, $limit, $count[0]->total_record);
			$orders=Orders::allOrdersPagination($current_page,$limit);	
			return view('admin/orders/index',['orders'=>$orders,
			'paginghtml'=>$paging->html(),'payments'=>$payments]);
		} else {
			$current_page = $_GET['page'];

			$paging->init("orders", $current_page, $limit, $count[0]->total_record);
			$orders=Orders::allOrdersPagination($current_page,$limit);
			$tbody = '';
			foreach($orders as $item){
				$id=$item->id_order;
				$username=$item->username;
				$fullname=$item->fullname;
				$address=$item->address;
				$date_order=$item->date_order;
				$status=$item->status;
				$paid=$item->paid;
				$shipped=$item->shipped;
				$payment=$item->name;
				$note=$item->note;
				$tbody .= '<tr>
				  <td class="text-center">'.$id.'</td>
				  <td class="text-center">'.$username.'</td>
				  <td class="text-center">'.$fullname.'</td>
				  <td class="text-center">'.$address.'</td>
				  <td class="text-center">'.
					 date("d/m/Y H:i:s", strtotime($date_order)).'
				  </td>
				  <td class="text-center">
				   <select id="status-'.$id.'"'; 
				    if($_SESSION['user'][0]->level!=1) {
						$tbody .= "disabled";
					 } 
					 $tbody .= 'name="status" class="multiselect status">';
					 $arr = array("Confirmed", "Pending", "Cancel");
					 for($i = 0; $i < 3; $i++) {
						$tbody .= '<option';
						if($status==0) $tbody .= 'selected="selected"';
						$tbody .= 'value="'.$i.'">'.$arr[$i].'</option>';
					 }
					 $tbody .= '</select>
				 </td>
				 <td class="text-center">
				  ';
				   if($_SESSION['user'][0]->level!=1){
					$tbody .= '<img src="/public/admin/assets/images/'; 
					if($paid==1){
						$tbody .= 'active.gif';
					}else{
						$tbody .= 'deactive.gif';
					}
					$tbody .='" alt="">';
				  } else {
					$tbody .=' 
					<a href="javascript:void(0)" class="edit_paid_active" id="paid-'.$id.'">
					  <img src="/public/admin/assets/images/';
					  if($paid==1){
						$tbody .= 'active.gif';
					  }else{
						$tbody .= 'deactive.gif';
					  }
					  $tbody .='" alt=""></a>';
				  }
				  $tbody .= '</td>
				  <td class="text-center">';
				 if($_SESSION['user'][0]->level!=1){
					$tbody .= '<img src="/public/admin/assets/images/'; 
				  if($shipped==1){
					$tbody .= 'active.gif';
				  }else{
					$tbody .= 'deactive.gif';
				  }
				  $tbody .='" alt="">';
				} else {
					$tbody .='<a href="javascript:void(0)"  class="edit_shipped_active" id="shipped-'.$id.'">
					<img src="/public/admin/assets/images/'; 
					if($shipped==1){
						$tbody .='active.gif';
					}else{
						$tbody .='deactive.gif';
					}
					$tbody .='" alt=""></a>';
				}
				$tbody .='</td>
			  <td class="text-center">'.$payment.'</td>
			  <td class="text-center">'.$note.'</td>
			  <td class="text-center">
			    <a href="/admin/orders/detail/'.$id.'" alt="">Details</a>
			  </td>
			
			<td class="text-center">
			  <div class="hidden-sm hidden-xs btn-group">
				<a class="btn btn-xs btn-danger" onclick="return confirm(\'Are you sure to delete ?\');" href="/admin/orders/delete/'.$id.'">
				  <i class="ace-icon fa fa-trash-o bigger-120"></i>
				</a>
			  </div>
			</td>
			<td class="text-center">
			  <input type="checkbox" name="dels[]" value="'.$id.'" />
			</td>
		  </tr>'; 
		}
			$paging_html =  $paging->html();
			echo json_encode(array(
				"tbody" => $tbody, 
			"paging" => $paging_html));
		}
	}
	

	public function updateStatus()
	{	
		$id=$_GET['id'];
		$status=$_GET['status'];
		$order=Orders::updateStatus($status,$id);
		echo 'success';
	}

	public function changeActivePaid()
	{
		$id=$_GET['id'];
		$order=Orders::find($id);
		if($order[0]->paid==1){
 		if(Orders::updateActivePaid(0,$id)){
		     echo '<img src="/public/admin/assets/images/deactive.gif" alt="">';
			}
		}else{
			if(Orders::updateActivePaid(1,$id)){
				echo '<img src="/public/admin/assets/images/active.gif" alt="">';
			}
		}
		
	}

	public function changeActiveShipped()
	{
		$id=$_GET['id'];
		$order=Orders::find($id);
		if($order[0]->shipped==1){
			if(Orders::updateActiveShipped(0,$id)){
				echo '<img src="/public/admin/assets/images/deactive.gif" alt="">';
			}
		}else{
			if(Orders::updateActiveShipped(1,$id)){
				echo '<img src="/public/admin/assets/images/active.gif" alt="">';
			}
		}
		
	}

	public function destroy($id)
	{	
		if($_SESSION['user'][0]->level==1)
		{
			if(Orders::delete($id)){
				if(Orders::deleteOrderDetail($id))
				{
					Session::createSession('msg','Deleted Successfully!');
					return redirect('admin/orders');
				}
			} 
		} else {
			Session::createSession('msg','Non-permission');
			return redirect('admin/orders');

		}
	}

	public function pagination($count,$link_full)
	{
		$config = array(
			    'current_page'  => isset($_GET['p']) ? $_GET['p'] : 1, // Trang hiện tại
			    'total_record'  => $count, // Tổng số record
			 	//  'limit'         => 10,// limit
			    'link_full'     => $link_full, //'/admin/users?p={page}' =Link full có dạng như sau: domain/com/page/{page}
			    'link_first'    => str_replace('{page}', '1', $link_full),// Link trang đầu tiên
			    'range'         => 9, // Số button trang bạn muốn hiển thị 
			    );
		$paging = new Pagination();
		$paging->init($config);
		$paginghtml = $paging->html();
		return  array('config' => $paging->_config, 'paginghtml' => $paginghtml, );
	} 


	public function search()
	{
		if(isset($_REQUEST['search'])||isset($_REQUEST['fullname']))
		{
			$payments=Payment::all();
			$fullname=$_REQUEST['fullname'];
			$paid=$_REQUEST['paid'];
			$shipped=$_REQUEST['shipped'];
			$status=$_REQUEST['status'];
			$payment=$_REQUEST['payment'];
			$date_order=$_REQUEST['date_order'];
			$search_Order = array(
				'fullname' =>$fullname, 
				'paid' =>$paid, 
				'shipped' =>$shipped,
				'status' =>$status, 
				'payment' =>$payment, 
				'date_order' =>$date_order
				);
			$params=http_build_query($search_Order);

			$ArrOrders=Orders::search($search_Order);

			$link_full='/admin/orders/search?p={page}&'.$params;
			$count=count($ArrOrders);
			$pagination = $this->pagination($count,$link_full);
			$paginghtml = $pagination['paginghtml'];
			$limit = $pagination['config']['limit'];
			$current_page = $pagination['config']['current_page'];
			$orders=Orders::allSearch($current_page,$limit,$search_Order);	
			return view('admin/orders/index',['orders'=>$orders, 'paginghtml'=>$paginghtml,'search_Order'=>$search_Order,'payments'=>$payments]);
		} else {
			return redirect('admin/orders');

		}
		
	}

	public function detail($id)
	{	
		$order_details=Orders::detail($id);
		return view('admin/orders/detail',['order_details'=>$order_details]);
	}

	public function destroyAll()
	{	
		
		if($_SESSION['user'][0]->level==1)
		{
			$del=$_POST['dels'];
			foreach ($del as $key => $value) {
				Orders::delete($value);
				Orders::deleteOrderDetail($value);
			}
			Session::createSession('msg','Deleted Successfully!');
			return redirect('admin/orders');
		} else {
			Session::createSession('msg','Non-permission');
			return redirect('admin/orders');
		}
	}

}


?>
