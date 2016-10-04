<?php
namespace Vender;
use Config\App;

Class Helper
{
	public static function url($url){
		$baseURI = new App;
		$baseURI = preg_replace('/(\/)$/', '', $baseURI->config('BASE_URL'));
		$url = preg_replace('/^(\/)|(\/)$/', '', $url);
		$newUrl = $baseURI.'/'.$url;
		return $newUrl;
	}
}