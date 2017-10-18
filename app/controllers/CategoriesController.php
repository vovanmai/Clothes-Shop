<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Category;
use core\Pagination;

class CategoriesController
{
    function __construct() {
        checkExist();
    }
	public function index()
	{
		// $categories= Category::all();	
		// return view('admin/categories/index',['categories'=>$categories]);
	}
	

	public function store()
	{
	
	}



	public function update()
	{	
	
	}

	
	public function destroy()
	{	
		
	}
}
	?>
