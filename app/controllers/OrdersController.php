<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Orders;
use app\models\Payment;
use core\Pagination;
use app\controllers\AuthController;
class OrdersController
{
	function __construct() {
		checkExist();
	}
	public function index()
	{
		$payments=Payment::all();
		$link_full='/admin/orders?p={page}';
		$count=Orders::count();
		$pagination = $this->pagination($count[0]->total_record,$link_full);
		$paginghtml = $pagination['paginghtml'];
		$limit = $pagination['config']['limit'];
		$current_page = $pagination['config']['current_page'];
		$orders=Orders::allOrdersPagination($current_page,$limit);	
		return view('admin/orders/index',['orders'=>$orders,'paginghtml'=>$paginghtml,'payments'=>$payments]);
	}
	

	public function updateStatus()
	{	
		$id=$_GET['id'];
		$status=$_GET['status'];
		$order=Orders::updateStatus($status,$id);
		if ($status ==0) {
			$email = Orders::getEmail($id)[0]->email;
			$auth = new AuthController;
			$auth->sendMail($email,'Xác nhận đơn hàng','Cảm ơn bạn đã tin tưởng và lựa chọn sản phẩm của shop, đơn hàng của bạn đã đưọc xác nhận và gửi đi trong thời gian sớm nhất !');
		}
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
