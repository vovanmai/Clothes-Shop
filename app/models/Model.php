<?php 
namespace app\models;
use core\App;
use \PDO;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;


class Model
{

	public static $table;

	public static function all()
	{
		$query="SELECT * FROM ".static::$table;
		return App::get('database')->query_fetch($query);
	}

	public static function find($id)
	{
		$query="SELECT * FROM ".static::$table." WHERE id=?";
		return App::get('database')->query_fetch_params($query,array('id'=>$id));
	}

	public static function insert($parameters)
	{	
		$query=sprintf(
			'insert into %s(%s) value(%s)',
			static::$table,
			implode(',',array_keys($parameters)),
			implode(', ',array_fill(0,count($parameters),'?'))
			);
		return App::get('database')->query_excute_params($query,$parameters);

	}


	public static function update($id,$parameters)
	{
		$string="";
		foreach ($parameters as $key => $value) {
			$string=$string.$key.'=?,';
		}
		$finished_string=trim($string,",");	
		$parameters['id']=$id;
		$query="UPDATE ".static::$table." SET $finished_string WHERE id=?";
		return App::get('database')->query_excute_params($query,$parameters);
	}

	public static function delete($id)
	{
		$query="DELETE FROM ".static::$table." WHERE id=?";
		return App::get('database')->query_excute_params($query,array('id'=>$id));
	}

}
?>
