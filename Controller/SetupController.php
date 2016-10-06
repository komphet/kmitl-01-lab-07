<?php
namespace Controller;
use Vender\View;
use Vender\DB;
use Vender\Helper;
use Config\App;

Class SetupController extends View
{
	public function __construct()
	{
		switch ($_SERVER['REQUEST_METHOD']) {
			case 'GET':
				return $this->index();
				break;
			case 'POST':
				return $this->store($_POST);
				break;
		}
	}

	protected function index()
	{
		$config = App::all();
		return View::make('page.setup',compact('config'));
	}

	protected function store($request)
	{
		$file = '.env';
		$file_contents = file_get_contents($file);
		$fh = fopen($file, "w");

		$file_contents = preg_replace('/(DB_DATABASE=).*\s*/', 'DB_DATABASE='.$request['databese'].PHP_EOL, $file_contents);
		$file_contents = preg_replace('/(BASE_URL=).*\s*/', 'BASE_URL='.$request['baseurl'].PHP_EOL, $file_contents);
		$file_contents = preg_replace('/(DB_USERNAME=).*\s*/', 'DB_USERNAME='.$request['username'].PHP_EOL, $file_contents);
		$file_contents = preg_replace('/(DB_PASSWORD=).*\s*/', 'DB_PASSWORD='.$request['password'].PHP_EOL, $file_contents);

		fwrite($fh, $file_contents);
		fclose($fh);

		$db = new DB;
		if(!$db->connect()) return Helper::redirect('setup');
		if($request['createTable']){
			$create = $db->create('person',[
				'`ID` VARCHAR(10) PRIMARY KEY',
			    '`Name` VARCHAR(25) CHARACTER SET utf8 NOT NULL',
			    '`Date of Birth` DATE NOT NULL',
			    '`Weight` INT(6) NOT NULL',
			    '`Gender` ENUM("M","F") CHARACTER SET utf8 NOT NULL'
			]);
			if(!$create) Helper::redirect('setup');
			$insert = $db->insert('person',[
				[
					'ID'            => $request['id'],
					'Name'          => $request['fname'].' '.$request['lname'],
					'Date of Birth' => $request['dateofbirth'],
					'Weight'        => $request['weight'],
					'Gender'        => $request['gender']
				],
			]);
			if(!$insert) Helper::redirect('setup');
		}
		Helper::flush('success','ปรับปรุงการตั้งค่าเรียบร้อยแล้ว!');
		return Helper::redirect('/setup');
	}
}