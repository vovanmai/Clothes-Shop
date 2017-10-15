<?php
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;
use app\models\User;
use core\Pagination;


class UserController
{
	
	public function index(){
		$parameters=array(
    		'username'=>'tuongvy1902'
    		);
		$ex=User::update("users",1029,$parameters);
		if($ex){
			echo "updated successfully";
		}else{
			echo "loi";
		}
		// echo "<pre>";
		// 	print_r($user);
		// echo "</pre>";
		// die();	

	}
}
?>