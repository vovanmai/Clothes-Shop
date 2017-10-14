<?php 
namespace app\models;
use core\App;
use \PDO;
use core\Session;
use core\database\QueryBuilder;
use core\database\Connection;


class Model
{
    

	public static function all($tbl)
	{
        $query="SELECT * FROM $tbl";
        return App::get('database')->query_fetch($query);
	}

	public static function find($tbl,$id)
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

	public static function update($tbl,$id,$parameters)
	{
		$string="";
		foreach ($parameters as $key => $value) {
			if(is_int($value)){
				$string=$string.$key.'='.$value.' ,';
			}else{
				$string=$string.$key.'="'.$value.'" ,';
			}
		}
		$finished_string=trim($string,",");	
		$query="UPDATE $tbl SET $finished_string WHERE id=$id";

		return App::get('database')->query_excute($query);
	}

	public static function delete($tbl,$id)
    {
        $query="DELETE FROM $tbl WHERE id=$id";
        return App::get('database')->query_excute($query);
    }

}
?>