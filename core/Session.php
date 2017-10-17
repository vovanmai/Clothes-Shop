<?php
namespace core;

class Session
{
	public static function createSession($msgKey,$message)
	{
		session_start();
		$_SESSION[$msgKey]=$message;
		
	}

	public static function getSession($msgKey)
	{

		if(isset($_SESSION[$msgKey])){
			return $_SESSION[$msgKey];
		} else {
			return null;
		}
	}

	public static function unsetSession($msgKey)
	{
		if(isset($_SESSION[$msgKey])){
			unset($_SESSION[$msgKey]);
		} 
	}
}
?>