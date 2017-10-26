<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Category;
use core\Pagination;

class AdminCatController
{
    function __construct() {
        checkExist();
    }
	public function index()
	{

		$cat= Category::all();
		return view('admin/cat/index',['cat'=>$cat]);
	}
	

	public function add()
	{
		return view('admin/cat/add');
	}
	public function store()
	{
		$name=$_POST['cat_name'];
		$gender=$_POST['cat_gender'];
		$arrCat= array(
			'name' => $name,
			'gender' => $gender,
			);
		if(Category::insert($arrCat)){
			Session::createSession('msg','Inserted Successfully !');
			return redirect('admin/cat');
		}
	}


	public function edit($id)
	{

		$arrCat=Category::find('id',$id);
		if(empty($arrCat)){
			redirect('admin/cat');
		}
		return view('admin/cat/edit',['arrCat'=>$arrCat]);
	}

	public function update($id)
	{	

		$name=$_POST['cat_name'];
		$gender=$_POST['cat_gender'];
		
		$arrCat= array(
			'name' => $name,
			'gender' => $gender,
		);

		if(empty(Category::checkCat($arrCat,$id))){
			if(Category::update($arrCat,$id)){
			Session::createSession('msg','Updated Successfully !');
			return redirect('admin/cat');
			}
		}else{
			Session::createSession('msg','Category already exists !');
			return redirect('admin/cat');	
		}

	}
	public function destroy($id)
	{	
		if (empty(Category::checkDeleteConstrain('products_info',$id))) {
			if(Category::delete($id)){
				Session::createSession('msg','Deleted Successfully!');
				return redirect('admin/cat');
			} 
		} else {
			Session::createSession('msg','Error Constrain with Products!');
			return redirect('admin/cat');
		}

		if(Category::delete($id)){
			Session::createSession('msg','Deleted Successfully !');
			return redirect('admin/cat');
		}
	}
		
}
	?>
