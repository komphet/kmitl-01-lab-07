<?php
namespace Controller;
use Vender\View;
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
		$config = App::all();
		return View::make('page.setup',compact('config'));
	}
}