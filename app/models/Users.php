<?php 
namespace app\models;
use core\App;


class Users
{

		public static function all($current_page, $limit)
	{
		$start = ($current_page - 1) * $limit;
		$query='select * from users limit '.$start.', '.$limit;
		return App::get('database')->query_fetch($query);
	}
	public static function count()
	{
		$query='select count(*) as total_record from users';
		return App::get('database')->query_fetch($query);
	}
	public static function find($id)
	{
		$query='select * from users where id='.$id;
		return App::get('database')->query_fetch($query);
	}

	public static function insert($new_User){
		$username=$new_User['username'];
		$password=$new_User['password'];
		$fullname=$new_User['fullname'];
		$email=$new_User['email'];
		$phone=$new_User['phone'];
		$address=$new_User['address'];
		$level=$new_User['level'];
		$avatar=$new_User['avatar'];
		$query="INSERT INTO users(username,password,fullname,email,phone,address,level,avatar)
		VALUES('{$username}','{$password}','{$fullname}','{$email}','{$phone}','{$address}',{$level},'{$avatar}')";
		return App::get('database')->query_excute($query);

	}

	public static function delete($id)
	{
		$query="DELETE FROM users WHERE id={$id}";
		return App::get('database')->query_excute($query);
	}

	public function deleteById($id)
	{
		$query='delete from users where id='.$id;
		return App::get('database')->query_excute($query);
	}

	public static function update($edited_User,$id)
	{
		$username=$edited_User['username'];
		$password=$edited_User['password'];
		$fullname=$edited_User['fullname'];
		$email=$edited_User['email'];
		$phone=$edited_User['phone'];
		$address=$edited_User['address'];
		$level=$edited_User['level'];
		$avatar=$edited_User['avatar'];

		$query="UPDATE users SET   	username='{$username}',
								   	password='{$password}',
								   	fullname='{$fullname}',
									email='{$email}',	
									phone='{$phone}',	
									address='{$address}',	
									level={$level},
									avatar='{$avatar}'	
								   	WHERE id={$id}";						   	
		return App::get('database')->query_excute($query);						   	
	}

	public static function updateActive($active,$id)
	{
		$query="UPDATE users SET active={$active} WHERE id={$id}";
		return App::get('database')->query_excute($query);	
	}

	public static function search($search_User)
	{
		$username=$search_User['username'];
		$fullname=$search_User['fullname'];
		$active=$search_User['active'];
		$level=$search_User['level'];
		$query='select * from users where 1'; 
		if($username!='')
		{
			$query.=' and username like "%'.$username.'%"';
		}
		if($fullname!='')
		{
			$query.=' and fullname like "%'.$fullname.'%"';
		}
		if($active!=-1)
		{
			$query.=' and active ='.$active;
		}
		if($level!=0)
		{
			$query.=' and level ='.$level;
		}
		return App::get('database')->query_fetch($query);
	}

}
?>