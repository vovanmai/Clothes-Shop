<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use core\Pagination;

class ColorsController
{
    function __construct() {
        checkExist();
    }
	public function index()
	{
		$colors= Colors::all();	
		return view('admin/users/index',['users'=>$users, 'paginghtml'=>$paginghtml]);
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
			$auser=Users::find($id);
			return view('admin/users/edit',['auser'=>$auser]);
		} else {
			Session::createSession('msg','Non-permission');
			return redirect('admin/users');
		}
		

	}

	public function update($id)
	{	
		$user=Users::find($id)[0];
		
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
						'username' => $username, 
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

		


	
	

}


	?>
