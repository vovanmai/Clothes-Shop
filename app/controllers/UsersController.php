<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use core\Pagination;
class UsersController
{
	public function index()
	{
		$link_full='/admin/users?p={page}';
		$count=Users::count();
		$pagination = $this->pagination($count[0]->total_record,$link_full);
		$paginghtml = $pagination['paginghtml'];
		$limit = $pagination['config']['limit'];
		$current_page = $pagination['config']['current_page'];
		$users=Users::all($current_page,$limit);	
		return view('admin/users/index',['users'=>$users, 'paginghtml'=>$paginghtml]);
	}
	public function add()
	{
		if($_SESSION['user'][0]->level==1)
		{
			return view('admin/users/add');
		} else {
			return redirect('admin/users?msg=Non-permission');
		}
		
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
		//check phan quyen nge :)))
		if(Users::auth($id))
		{
			$user=Users::find($id);
			return view('admin/users/edit',['user'=>$user]);
		} else {
			return redirect('admin/users?msg=Non-permission');
		}
		
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
		if($user[0]->level==1)
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
		} else {
			return redirect('admin/users?msg=Non-permission');
		}
		
	}

	public function destroy()
	{	
		if($_SESSION['user'][0]->level==1)
		{
			$id=$_GET['id'];
			if(Users::delete($id)){
				return redirect('admin/users?msg=Deleted Successfully!');
			} else {
				return redirect('admin/users?msg=Non-permission');

			}
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
			$username=$_REQUEST['username'];
			$fullname=$_REQUEST['fullname'];
			$active=$_REQUEST['active'];
			$level=$_REQUEST['level'];
			$search_User = array(
				'username' =>$username, 
				'fullname' =>$fullname, 
				'active' =>$active, 
				'level' =>$level
				);
			$params=http_build_query($search_User);

			$ArrUsers=Users::search($search_User);

			$link_full='/admin/users/search?p={page}&'.$params;
			$count=count($ArrUsers);
			$pagination = $this->pagination($count,$link_full);
			$paginghtml = $pagination['paginghtml'];
			$limit = $pagination['config']['limit'];
			$current_page = $pagination['config']['current_page'];
			$users=Users::allSearch($current_page,$limit,$search_User);	
			return view('admin/users/index',['users'=>$users, 'paginghtml'=>$paginghtml,'search_User'=>$search_User]);
		}


	}

	?>