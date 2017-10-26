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
		$link='/admin/orders?p={page}';
		$payments=Payment::all();
		$all_pages = count(Orders::allOrdersPagination(0, 0)); 
		$limit = 10;
		$paging = new Pagination();
		$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$paging->init("",$link, $current_page, $limit, $all_pages);
		$orders = Orders::allOrdersPagination($current_page,$limit);	
		return view('admin/orders/index',['orders'=>$orders,
		'paging'=>$paging->gethtml(),'payments'=>$payments]);
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

		if ($status ==2) {
			$email = Orders::getEmail($id)[0]->email;
			$auth = new AuthController;
			$auth->sendMail($email,'Hủy bỏ đơn hàng ','Cảm ơn bạn đã tin tưởng và lựa chọn sản phẩm của shop, tuy nhiên đã có lỗi trong quá trình đặt hàng ,vui lòng quy lại shop và đặt lại hàng , chúng tôi rất xin lỗi ,xin cảm ơn !');
		}
		echo 'Update  status Successfully !';
	}

	public function changeActivePaid()
	{
		$id=$_GET['id'];
		$order=Orders::find('id',$id);
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
		$order=Orders::find('id',$id);
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
		$fullname = isset($_GET['fullname']) ? $_GET['fullname']: '';
		$paid = isset($_GET['paid']) ? $_GET['paid']: -1;
		$shipped = isset($_GET['shipped']) ? $_GET['shipped']: -1;
		$status = isset($_GET['status']) ? $_GET['status']: -1;
		$payment = isset($_GET['payment']) ? $_GET['payment']: -1;
		$date_order = isset($_GET['date_order']) ? $_GET['date_order']: '';
		$search_Order = array(
			'fullname' =>$fullname, 
			'paid' =>$paid, 
			'shipped' =>$shipped,
			'status' =>$status, 
			'payment' =>$payment, 
			'date_order' =>$date_order
			);

		foreach(array_keys($search_Order) as $key) {				
			if ($search_Order[$key]=='' || $search_Order[$key]==-1) {
				unset($search_Order[$key]);
			}
		}
		if(!empty($search_Order)) {
			$current_page = isset($_GET['p']) ? $_GET['p']: 1;
			$limit = 10;
			$params=http_build_query($search_Order);
			$link = "/admin/orders/search?$params&p={page}";
			$paging = new Pagination();
			$all_pages = count(Orders::search($search_Order,0,0));
			$paging->init("",$link,$current_page, $limit, $all_pages);
			$orders = Orders::search($search_Order, $current_page, $limit);
			$payments=Payment::all();	
			return view('admin/orders/index',['orders'=>$orders, 
			'search_Order'=>$search_Order,'payments'=>$payments,
			'paging'=>$paging->gethtml()]);
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
