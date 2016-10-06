<?php
namespace Vender;
use Config\App;
use Vender\Helper;
use Vender\View;
use PDO;

Class DB
{
	protected $db;
	protected $servername;
	protected $dbname;
	protected $username;
	protected $password;

	public function __construct()
	{
		$this->servername = "localhost";
		$this->dbname     = App::config('DB_DATABASE');
		$this->username   = App::config('DB_USERNAME');
		$this->password   = App::config('DB_PASSWORD');
		$this->connect();
	}

	public function connect(){
		try
		{
		    $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname;charset=utf8",$this->username,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $this->db = $conn;
		    return $conn;
		}
		catch(\PDOException $e)
		{
			Helper::errors($e->getMessage());
		    return false;
		}
	}

	public function create($table,$schemas){
		$tableExists  = $this->db->query('SHOW TABLES LIKE "'.$table.'"')->rowCount();
		if(!$tableExists){
			$sql = "CREATE TABLE ".$table." (";
			$countSchema = count($schemas);
			foreach ($schemas as $key => $schema) {
				$sql .= $schema;
				if($countSchema != $key+1) $sql .= ',';
			}
			$sql .= ");";
			$exac = $this->db->exec($sql);
			return true;
		}else{
			Helper::errors('Error!: Table is exists!');
			return false;
		}
	}

	public function insert($table,$data){

		try
		{
			foreach ($data as $key => $value) {
				$count = count($value);
				$stmtStr = '$stmt = $this->db->prepare("INSERT INTO `'.$table.'` (';
				foreach ($value as $keyColumn => $valueColumn) {
					$stmtStr .= '`'.$keyColumn.'`';
					$k++;
					if($count != $k) $stmtStr .= ',';
				}
				$stmtStr .= ') VALUES (';
				foreach ($value as $keyColumn => $valueColumn) {
					$stmtStr .= ':'.str_replace(' ', '_', $keyColumn);
					$j++;
					if($count != $j) $stmtStr .= ',';
				}
				$stmtStr .= ')");';

				eval($stmtStr);

				foreach ($value as $keyColumn => $valueColumn) {
					$stmt->bindParam(':'.str_replace(' ', '_', $keyColumn), ${str_replace(' ', '_', $keyColumn)});
					${str_replace(' ', '_', $keyColumn)} = $valueColumn;
				}
				//var_dump($stmtStr);

				$stmt->execute();
				return true;
			}
		}
		catch(\PDOException $e)
		{
			Helper::errors('Error DataBase Connection: '.$e->getMessage());
		    return false;
		}
	}

	public static function delete($table,$id)
	{

		try {
			$db = new DB;
			$stmt = $db->connect()->prepare("DELETE FROM ".$table." WHERE `ID` = :id");
		    if(is_array($id)){
		    	foreach ($id as $value) {
		    		$stmt->bindParam(':id',$value);
					$stmt->execute();
		    	}
			}else{
				$stmt->bindParam(':id',$id);
				$stmt->execute();
			}
			return $id;
		}
		catch(\PDOException $e) {
		    Helper::errors('Error: '.$e->getMessage());
		    return false;
		}


	}

	public static function update($table,$id,$data){
		try {
			$db = new DB;
			$stmtStr = '$stmt = $db->connect()->prepare("UPDATE '.$table.' SET ';
				foreach ($data as $key => $value) {
					$stmtStr .= '`'.$key.'`=:'.str_replace(' ', '_', $key);
					$g++;
					if($g != count($data)) $stmtStr .= ', ';
				}
			$stmtStr .=' WHERE `ID` = '.$id.'");';
			eval($stmtStr);
			foreach ($data as $keydata => $valuedata) {
				$stmt->bindValue(':'.str_replace(' ', '_', $keydata),$valuedata);
			}
			$stmt->execute();
			return true;
		}
		catch(\PDOException $e) {
		    Helper::errors('Error: '.$e->getMessage());
		    return false;
		}
	}
}