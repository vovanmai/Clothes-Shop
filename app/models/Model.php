<?php 
namespace app\models;
use core\App;
use \PDO;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;


class Model
{
	protected $tbl;
	
	public static function all()
	{
        $query="SELECT * FROM $tbl";
        return App::get('database')->query_fetch($query);
	}

	public static function find($id)
	{
        $query="SELECT * FROM $tbl WHERE id=$id";
        return App::get('database')->query_fetch($query);
	}

	public static function insert($tbl,$parameters)
    {	
        $query=sprintf(
            'insert into %s(%s) value(%s)',
           	$tbl,
            implode(',',array_keys($parameters)),
            implode(', ',array_fill(0,count($parameters),'?'))
            );
        return App::get('database')->query_excute_params($query,$parameters);

    }

	public static function update($id,$parameters)
	{
		$string="";
		$query=sprintf(
            'UPDATE %s SET %s = ?  WHERE id = ',
           	$tbl,
            implode(' = ?,',array_keys($parameters))
            ). $id;
		return App::get('database')->query_excute_params($query, $parameters);
	}

	public static function delete($id)
    {
        $query="DELETE FROM $tbl WHERE id=$id";
		return App::get('database')->query_excute($query);
    }

}
?>