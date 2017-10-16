<?php
	
	return [
		'database'=>[
			'name' =>'shop',
			'username'=>'root',
			'password'=>'123456',
			'connection'=>'mysql:host=127.0.0.1',
			'options'=>[
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
				PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
			]
		]
	];
?>