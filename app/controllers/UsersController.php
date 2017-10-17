<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use core\Pagination;

class UsersController
{
    function __construct() {
        checkExist();
    }
	public function index()
	{
		$link_full ='/admin/users?p={page}';
		$limit = 10;
		$count=Users::count();
		$current_page = isset($_GET['p']) ? $_GET['p'] : 1;
		$paging = new Pagination();
		$paging->init($current_page, $limit, $link_full, $count[0]->total_record);
		$users=Users::allPagination($current_page,$limit);	
		return view('admin/users/index',['users'=>$users, 'paginghtml'=>$paging->html()]);
	}
	public function add()
	{
		if($_SESSION['user'][0]->level==1)
		{
			return view('admin/users/add');
		} else {
			Session::createSession('msg','Non-permission');
			return redirect('admin/users');
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
			$avatar=$_FILES['avatar']['name'];
			$new_User = array(
				'username' =>$username, 
				'password' =>$password, 
				'fullname' =>$fullname, 
				'email' =>$email, 
				'phone' =>$phone, 
				'address' =>$address, 
				'level' =>2
				);
			if($avatar==''){
				$new_User['avatar']='';
				if(Users::insert($new_User)){
					Session::createSession('msg','Added Successfully!');
					return redirect('admin/users');
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
						Session::createSession('msg','Added Successfully!');
						return redirect('admin/users');
					}
				}
			}
		}
	}

	public function edit($id)
	{
		//check phan quyen nge
		if(Users::auth($id))	
		{
			$auser=Users::find("id",$id);
			return view('admin/users/edit',['auser'=>$auser]);
		} else {
			Session::createSession('msg','Non-permission');
			return redirect('admin/users');
		}
		

	}

	public function update($id)
	{	
		$user=Users::find("id",$id)[0];
		
		if(isset($_POST['submit'])){
			$password=$_POST['password'];
			$fullname=$_POST['fullname'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$avatar=$_FILES['avatar']['name'];
			
			if($password==''){
				if($avatar==''){
					$edited_User=array(
						'password' => $user->password, 
						'fullname' => $fullname, 
						'email' => $email, 
						'phone' => $phone, 
						'address' => $address,  
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
						'password' => $user->password, 
						'fullname' => $fullname, 
						'email' => $email, 
						'phone' => $phone, 
						'address' => $address,  
						'avatar' => $new_file_name
					  );
				}	
			}else{
				if($avatar==''){
					$edited_User=array( 
						'password' => md5($password), 
						'fullname' => $fullname, 
						'email' => $email, 
						'phone' => $phone, 
						'address' => $address, 
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
						'password' => md5($password), 
						'fullname' => $fullname, 
						'email' => $email, 
						'phone' => $phone, 
						'address' => $address, 
						'avatar' => $new_file_name
						);
				}
			}
			if(Users::update($edited_User,$id)){
				Session::createSession('msg','Edited Successfully!');
				return redirect('admin/users');
			}
		}
	}

	public function changeActive()
	{
		if($_SESSION['user'][0]->level==1)
		{
			$id=$_GET['id'];
			$user=Users::find("id",$id);
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
			Session::createSession('msg','Non-permission');
			return redirect('admin/users');
		}
		
	}

	public function destroy()
	{	
		if($_SESSION['user'][0]->level==1)
		{
			$id=$_GET['id'];
			if(Users::delete($id)){
				Session::createSession('msg','Deleted Successfully!');
				return redirect('admin/users');
			} 
		} else {
			Session::createSession('msg','Non-permission');
			return redirect('admin/users');

		}
	}

		public function search()
		{
			if(isset($_REQUEST['search'])||isset($_REQUEST['username']))
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
				$paging = new Pagination();
				$limit = 10;
				$count = count($ArrUsers);
				$current_page = isset($_GET['p']) ? $_GET['p'] : 1;
				$paging->init($current_page, $limit, $link_full, $count);
				$users=Users::allSearch($current_page,$limit,$search_User);	
				return view('admin/users/index',['users'=>$users, 'paginghtml'=>$paging->html(),'search_User'=>$search_User]);
			} else {
				return redirect('admin/users');

			}
				
		}

	public function checkUsername()
	{
		$username=$_GET['username'];
		$user=Users::find("username",$username);
		if($user==null){
			echo 1;
		}else{
			echo 0;
		}
	}
	//function check a added email existence.
	public function checkAddEmail()
	{
		$email=$_GET['email'];
		$user=Users::find("email",$email);
		if($user==null){
			echo 1;
		}else{
			echo 0;
		}
	}


	//function check a edited email existence.
	public function checkEditEmail()
	{
		$id=$_GET['id'];	
		$email=$_GET['email'];
		$currentEmail=Users::find("id",$id)[0]->email;
		if($email==$currentEmail){
			echo 1;	
		}else{
			$usedEmail=Users::find("email",$email);
			if($usedEmail==null){
				echo 1;
			}else{
				echo 0;
			}
		}
	}

}


	?>
