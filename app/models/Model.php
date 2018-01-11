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

	public static function allActive()
	{
		$query="SELECT * FROM ".static::$table." where active=1";
		return App::get('database')->query_fetch($query);
	}

	public static function allLimit($limit)
	{
		$query="SELECT * FROM ".static::$table." WHERE active=1 LIMIT ".$limit;
		return App::get('database')->query_fetch($query);
	}
	public static function allPagination($current_page, $limit)
	{
		$start = ($current_page - 1) * $limit;
		$query='select * from '.static::$table.' limit ?, ?';
		return App::get('database')->query_fetch_params($query,array('start'=>$start,'limit'=>$limit));
	}
	public static function count()
	{
		$query='select count(*) as total_record from '.static::$table;
		return App::get('database')->query_fetch($query);
	}
	public static function find($column, $value)
	{
		$query="SELECT * FROM ".static::$table." WHERE ". $column. " = ?";
		return App::get('database')->query_fetch_params($query,array($column => $value));
	}

	// public static function find($column, $value)
	// {
	// 	$query="SELECT * FROM ".static::$table." WHERE ". $column. " = ?";
	// 	return App::get('database')->query_fetch_params($query,array($column => $value));
	// }




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

	public static function update($parameters,$id)
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

	public static function getIdLast()
	{
		$query="SELECT id FROM ".static::$table." ORDER BY id DESC LIMIT 1";
		return App::get('database')->query_fetch($query);
	}

	public static function checkDeleteConstrain($nametable,$id)
	{
		$str='';
		if (strpos(static::$table, '_')) {
			$arr=explode('_', static::$table);
			$arr[0]=rtrim($arr[0],'s');
			$str=implode('_', $arr);
		} else {
			$str=rtrim(static::$table,'s');
		}

		$query="SELECT * FROM $nametable WHERE ".strtolower($str)."_id= $id ";
		return App::get('database')->query_fetch($query); 
	}

}
?>
