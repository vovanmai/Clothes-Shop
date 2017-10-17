<?php 
namespace app\models;
use core\App;
use \PDO;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;;

class Users extends Model
{
	public static $table="users";

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

	public static function findByUsername($username)
	{
		$query="select username from users where username=?";
		return App::get('database')->query_fetch_params($query,array('username'=>$username));
	}
	public static function findByEmail($email)
	{
		$query="select email from users where email=?";
		return App::get('database')->query_fetch($query,array('email'=>$email));
	}

	public static function updateActive($active,$id)
	{
		$query="UPDATE users SET active=? WHERE id=?";
		return App::get('database')->query_excute_params($query,array('active'=>$active,'id'=>$id));	
	}

	//login

	public static function checkLogin($username,$pass) {
		$query = "SELECT * FROM users WHERE active =1 AND level !=3 AND username=? AND password =md5(?)";

		return App::get('database')->query_fetch_params($query,array('username'=>$username,'password'=>$pass));
	}

	public static function checkEmail($email) {
		$query = "SELECT * FROM users WHERE active =?  AND email=?";
		
		$data = array(
			1 => (int)1,
			2 =>$email,
			
			);
		return App::get('database')->query_fetch_params($query,$data);
	}
 	//Get password

	public static function getPass($id,$pass) {
		$query = "UPDATE users SET password =md5(?) WHERE active =?  AND id =?";

		$data = array(
			1 => $pass,
			2 =>1,
			3 =>$id
			
			);
		return App::get('database')->query_excute_params($query,$data);
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