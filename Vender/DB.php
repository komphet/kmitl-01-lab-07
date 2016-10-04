<?php
namespace Vender;
use Config\App;

Class DB
{
	protected $db;

	public function __construct()
	{
		try
		{
		    $conn = new PDO("mysql:host=localhost;dbname=App::config('DB_DATABASE')",
		    				App::config('DB_USERNAME'),
		    				App::config('DB_PASSWORD')
		    		);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $this->db = $conn;
		}
		catch(PDOException $e)
		{
		    echo "Connection failed: " . $e->getMessage();
		}
	}
}