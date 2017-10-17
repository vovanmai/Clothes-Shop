<?php
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use app\models\User;
use core\Pagination;


class IndexController
{
	
	public function index(){
		return view('public/index'); 
	}
}
?>