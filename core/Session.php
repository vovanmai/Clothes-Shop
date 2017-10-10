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
		return $_SESSION[$msgKey];
	}

	public static function unsetSession($msgKey)
	{
		unset($_SESSION[$msgKey]);
	}
}
?>