<?php
namespace Config;

Class App
{
	public function __construct()
	{
		return $config;
	}
	
	protected $config = [
		'baseURL' => 'comsci'
	];

}