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
    		'username'=>'admin',
    		'level'   =>2
    		);
		$ex=User::update("users",1004,$parameters);
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