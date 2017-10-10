<?php 
namespace app\controllers;
use app\Core\App;
use app\Core\Session;
use app\models\Users;
use core\Pagination;
class UsersController
{
	public function index()
	{
		$pagination = $this->pagination();
		$paginghtml = $pagination['paginghtml'];
		$limit = $pagination['config']['limit'];
		$current_page = $pagination['config']['current_page'];
		$users=Users::all($current_page,$limit);	
		return view('admin/users/index',['users'=>$users, 'paginghtml'=>$paginghtml]);
	}
	public function add()
	{
		return view('admin/users/add');
	}

	public function store()
	{
		if(isset($_POST['submit'])){
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			$fullname=$_POST['fullname'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$level=$_POST['level'];
			$avatar=$_FILES['avatar']['name'];
			$new_User = array(
				'username' =>$username, 
				'password' =>$password, 
				'fullname' =>$fullname, 
				'email' =>$email, 
				'phone' =>$phone, 
				'address' =>$address, 
				'level' =>$level
				);
			if($avatar==''){
				$new_User['avatar']='';
				if(Users::insert($new_User)){
					return redirect('admin/users?msg=Added Successfully!');
				}
			}else{
				$tmp_name=$_FILES['avatar']['tmp_name'];
				$tmp=explode('.',$avatar);
				$file_end=end($tmp);
				$new_file_name='avatar-'.$username.'-'.time().'.'.$file_end;
				$pathUpload=$_SERVER['DOCUMENT_ROOT'].'/public/upload/avatar/'.$new_file_name;
				$uploadAction=move_uploaded_file($tmp_name, $pathUpload);
				if($uploadAction){
					$new_User['avatar']=$new_file_name;
					if(Users::insert($new_User)){
					return redirect('admin/users?msg=Added Successfully !');
					}
				}
			}
		}
	}

	public function edit($id)
	{	
		$user=Users::find($id);
		return view('admin/users/edit',['user'=>$user]);
	}

	public function update($id)
	{	
		$user=Users::find($id)[0];
		
		if(isset($_POST['submit'])){
			$username=$_POST['username'];
			$password=$_POST['password'];
			$fullname=$_POST['fullname'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$level=$_POST['level'];
			$avatar=$_FILES['avatar']['name'];
			
			if($password==''){
				if($avatar==''){
					$edited_User=array(
						'username' => $username, 
						'password' => $user->password, 
						'fullname' => $fullname, 
						'email' => $email, 
						'phone' => $phone, 
						'address' => $address, 
						'level' => $level, 
						'avatar' => $user->avatar
						);
				}else{
					if($user->avatar!=''){
						unlink($_SERVER['DOCUMENT_ROOT'].'/public/upload/avatar/'.$user->avatar);
					}
					$tmp_name=$_FILES['avatar']['tmp_name'];
					$tmp=explode('.',$avatar);
					$file_end=end($tmp);
					$new_file_name='avatar-'.$username.'-'.time().'.'.$file_end;
					$pathUpload=$_SERVER['DOCUMENT_ROOT'].'/public/upload/avatar/'.$new_file_name;
					$uploadAction=move_uploaded_file($tmp_name, $pathUpload);
					$edited_User=array(
						'username' => $username, 
						'password' => $user->password, 
						'fullname' => $fullname, 
						'email' => $email, 
						'phone' => $phone, 
						'address' => $address, 
						'level' => $level, 
						'avatar' => $new_file_name
						);
				}	
			}else{
				if($avatar==''){
					$edited_User=array(
						'username' => $username, 
						'password' => md5($password), 
						'fullname' => $fullname, 
						'email' => $email, 
						'phone' => $phone, 
						'address' => $address, 
						'level' => $level, 
						'avatar' => $user->avatar
						);
				}else{
					if($user->avatar!=''){
						unlink($_SERVER['DOCUMENT_ROOT'].'/public/upload/avatar/'.$user->avatar);
					}
					$tmp_name=$_FILES['avatar']['tmp_name'];
					$tmp=explode('.',$avatar);
					$file_end=end($tmp);
					$new_file_name='avatar-'.$username.'-'.time().'.'.$file_end;
					$pathUpload=$_SERVER['DOCUMENT_ROOT'].'/public/upload/avatar/'.$new_file_name;
					$uploadAction=move_uploaded_file($tmp_name, $pathUpload);
					$edited_User=array(
						'username' => $username, 
						'password' => md5($password), 
						'fullname' => $fullname, 
						'email' => $email, 
						'phone' => $phone, 
						'address' => $address, 
						'level' => $level, 
						'avatar' => $new_file_name
						);
				}
			}
			if(Users::update($edited_User,$id)){
					return redirect('admin/users?msg=Edited Successfully!');
				}
		}
	}

	public function changeActive()
	{
		$id=$_GET['id'];
		$user=Users::find($id);
		if($user[0]->active==1){
			if(Users::updateActive(0,$id)){
				echo '<img src="/public/admin/assets/images/deactive.gif" alt="">';
			}
		}else{
			if(Users::updateActive(1,$id)){
				echo '<img src="/public/admin/assets/images/active.gif" alt="">';
			}
		}
	}

	public function destroy()
	{	$id=$_GET['id'];
		if(Users::delete($id)){
			return redirect('admin/users?msg=Deleted Successfully!');
		}
	}
	public function pagination()
	{
		$count= Users::count();
		$config = array(
		    'current_page'  => isset($_GET['p']) ? $_GET['p'] : 1, // Trang hiện tại
		    'total_record'  => $count[0]->total_record, // Tổng số record
		 	//  'limit'         => 10,// limit
		    'link_full'     => '/admin/users?p={page}',// Link full có dạng như sau: domain/com/page/{page}
		    'link_first'    => '/admin/users?p=1',// Link trang đầu tiên
		    'range'         => 9, // Số button trang bạn muốn hiển thị 
		);
		$paging = new Pagination();
 		$paging->init($config);
 		$paginghtml = $paging->html();
 		return  array('config' => $paging->_config, 'paginghtml' => $paginghtml, );
	} 
	
}

?>