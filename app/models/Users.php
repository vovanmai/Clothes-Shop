<?php 
namespace app\models;
use core\App;
use \PDO;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;;

class Users
{

	public static function all($current_page, $limit)
	{
		$start = ($current_page - 1) * $limit;
		$query='select * from users limit ?, ?';
		return App::get('database')->query_fetch_params($query,array('start'=>$start,'limit'=>$limit));
	}

	public static function allSearch($current_page, $limit,$search_User)
	{
		$start = ($current_page - 1) * $limit;

		$username=$search_User['username'];
		$fullname=$search_User['fullname'];
		$active=$search_User['active'];
		$level=$search_User['level'];
		$query='select * from users where 1'; 
		$params=array();
		if($username!='')
		{
			$query.=' and username like concat("%", ?, "%")';
			$params['username']=$username;
		}
		if($fullname!='')
		{
			$query.=' and fullname like concat("%", ?, "%")';
			$params['fullname']=$fullname;
		}
		if($active!=-1)
		{
			$query.=' and active = ?';
			$params['active']=$active;
		}
		if($level!=0)
		{
			$query.=' and level = ?';
			$params['level']=$level;
		}

		
		$query.=' limit ?, ?';
		$params['start']=$start;
		$params['limit']=$limit;
		return App::get('database')->query_fetch_params($query,$params);
	}


	public static function count()
	{
		$query='select count(*) as total_record from users';
		return App::get('database')->query_fetch($query);
	}
	public static function find($id)
	{
		$query='select * from users where id=?';
		return App::get('database')->query_fetch_params($query,array('id'=>$id));
	}

	public static function findByUsername($username)
	{
		$query="select username from users where username='{$username}'";
		return App::get('database')->query_fetch($query);
	}
	public static function findByEmail($email)
	{
		$query="select email from users where email='{$email}'";
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
		VALUES(?,?,?,?,?,?,?,?)";
		$params=array(
			'username'=>$username,
			'password'=>$password,
			'fullname'=>$fullname,
			'email'=>$email,
			'phone'=>$phone,
			'address'=>$address,
			'level'=>$level,
			'avatar'=>$avatar
			);
		return App::get('database')->query_excute_params($query,$params);

	}

	public static function delete($id)
	{
		$query="DELETE FROM users WHERE id=?";
		return App::get('database')->query_excute_params($query,array('id'=>$id));
	}

	public function deleteById($id)
	{
		$query='delete from users where id=?';
		return App::get('database')->query_excute_params($query,array('id'=>$id));
	}

	public static function update($edited_User,$id)
	{
		
		$password=$edited_User['password'];
		$fullname=$edited_User['fullname'];
		$email=$edited_User['email'];
		$phone=$edited_User['phone'];
		$address=$edited_User['address'];
		$level=$edited_User['level'];
		$avatar=$edited_User['avatar'];

		$query="UPDATE users SET password= ?, fullname= ?, email= ?, phone= ?, address= ?, level= ?, avatar= ?	WHERE id= ?";
		$params=array(
		
			'password'=>$password,
			'fullname'=>$fullname,
			'email'=>$email,
			'phone'=>$phone,
			'address'=>$address,
			'level'=>$level,
			'avatar'=>$avatar,
			'id'=>$id
			);						   	
		return App::get('database')->query_excute_params($query,$params);						   	
	}

	public static function updateActive($active,$id)
	{
		$query="UPDATE users SET active=? WHERE id=?";
		return App::get('database')->query_excute_params($query,array('active'=>$active,'id'=>$id));	
	}



	public static function checkLogin($username,$pass) {
		$query = "SELECT * FROM users WHERE active =1 AND level !=3 AND username=? AND password =md5(?)";

		return App::get('database')->query_fetch_params($query,array('username'=>$username,'password'=>$pass));
	}

	public static function search($search_User)
	{
		$username=$search_User['username'];
		$fullname=$search_User['fullname'];
		$active=$search_User['active'];
		$level=$search_User['level'];
		$query='select * from users where 1'; 
		$params=array();
		if($username!='')
		{
			$query.=' and username like concat("%", ?, "%")';
			$params['username']=$username;
		}
		if($fullname!='')
		{
			$query.=' and fullname like concat("%", ?, "%")';
			$params['fullname']=$fullname;
		}
		if($active!=-1)
		{
			$query.=' and active = ?';
			$params['active']=$active;
		}
		if($level!=0)
		{
			$query.=' and level = ?';
			$params['level']=$level;
		}


		return App::get('database')->query_fetch_params($query,$params);
	}

	public static function auth($id)
	{
		if ( Session::getSession('user') !=null) {
			$user=Session::getSession('user');
			if($user[0]->level==1||$user[0]->id==$id)
			{
				return true;
			}else
			{
				return false;
			}
		}

	}

}
?>