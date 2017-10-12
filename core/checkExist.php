<?php
use core\Session;
function checkExist()
{
	if ( Session::getSession('user') ==null) {
		return view('admin/auth/login');
	}
}
?>