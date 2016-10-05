<?php
namespace Config;

Class App
{
	public static function all(){
		$dataAll = file_get_contents('.env');
		$dataEx = preg_split('/\s/', $dataAll);
		$dataOjb = [];
		foreach ($dataEx as $value) {
			$data = explode('=', $value);
			$dataOjb[$data[0]] = $data[1];
		}
		return $dataOjb;
	}

	public function config($config){
		$dataAll = file_get_contents('.env');
		preg_match('/'.$config.'=.*\s/', $dataAll, $data);
		$configData = trim( str_replace($config.'=', '', $data[0]) );
		return $configData;
	}
}