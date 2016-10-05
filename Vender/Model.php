<?php
namespace Vender;
use Vender\DB;
use Vender\Helper;

Class Model extends DB
{
	protected $table = null;

	public function table(){
		if(is_null($this->table)){
			$className = end(explode('\\', get_called_class()));
			$split     = preg_split('/[A-Z]/',$className,-1, PREG_SPLIT_NO_EMPTY);
			preg_match_all ('/[A-Z]/', $className,$match,PREG_SPLIT_NO_EMPTY);
			$tableName = '';
			foreach ($split as $key => $value) {
				if($key != 0) $tableName .= '_';
				$tableName .= $match[0][$key].$value;
			}
			$tableName = strtolower( $tableName );
			$this->table = $tableName;

			return $tableName;

		}else{
			return $this->table;
		}
	}

	public static function select($column,$oper,$key = null)
	{
		if(is_null($key)) {
			$key = $oper;
			$oper = '=';
		}
		$instance = new static;
		try {
			$db = new DB;
			$stmt = $db->connect()->prepare("SELECT * FROM ".$instance->table()." WHERE ".$column." ".$oper. " :key;");
			$stmt->bindParam(':key',$key);
		    if($stmt->execute()){
		    	return $stmt->fetchAll();
		    }
		}
		catch(\PDOException $e) {
		    Helper::errors('Error: '.$e->getMessage());
		    return false;
		}
	}

	public static function get(){
		$instance = new static;
		try {
			$db = new DB;
			$stmt = $db->connect()->prepare("SELECT * FROM ".$instance->table()." ORDER BY `id` ASC;");
		    if($stmt->execute()){
			    return $stmt->fetchAll();
		    }else{
		    	Helper::errors('Error: Can\'t find table "'.$instance->table().'"');
		    	Helper::flush('createTable','true');
		    	return false;
		    }
		}
		catch(\PDOException $e) {
		    Helper::errors('Error: '.$e->getMessage());
		    return false;
		}
	}

	public static function delete($id)
	{
		$instance = new static;
		$db = new DB;
		return $db->delete($instance->table(),$id);
	}

	public static function update($id,$data)
	{
		$instance = new static;
		$db = new DB;
		return $db->update($instance->table(),$id,$data);
	}

}