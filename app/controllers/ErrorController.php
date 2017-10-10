<?php 
namespace app\controllers;
use core\App;
use core\Session;
use app\models\Users;

class ErrorController
{
	public function error()
	{
		return view('error');
	}
}

?>