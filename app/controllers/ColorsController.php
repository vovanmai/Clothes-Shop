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
		return view('admin/colors/index',['users'=>$users, 'paginghtml'=>$paginghtml]);
	}
	public function add()
	{
		if($_SESSION['user'][0]->level==1)
		{
			return view('admin/colors/add');
		} else {
			Session::createSession('msg','Non-permission');
			return redirect('admin/colors');
		}
		
	}

	public function store()
	{
		if(isset($_POST['submit'])){
			$name=$_POST['name'];
			if(Colors::insert($name)){
				Session::createSession('msg','Added Successfully!');
				return redirect('admin/colors');	
			}
		}
	}

	public function edit($id)
	{
		//check phan quyen nge
		if(Users::auth($id))	
		{
			$auser=Colors::find("id", $id);
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
			$name=$_POST['name'];
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
