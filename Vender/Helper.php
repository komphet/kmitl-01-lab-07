<?php
namespace Vender;
use Config\App;

Class Helper
{
	public static function url($url)
	{
		$baseURI = new App;
		$baseURI = preg_replace('/(\/)$/', '', $baseURI->config('BASE_URL'));
		$url = preg_replace('/^(\/)|(\/)$/', '', $url);
		$newUrl = $baseURI.'/'.$url;
		return $newUrl;
	}

	public static function redirect($url)
	{
		header( 'refresh: 0; url='.self::url($url) );
 		exit(0);
	}

	public static function errors($errors)
	{
		$_SESSION['errors'] = [$errors];
		return true;
	}

	public static function session($name,$value = null)
	{
		if(is_null($value)){
			return $_SESSION[$name];
		}else{
			$_SESSION[$name] = $value;
		}
		return true;
	}

	public static function flush($name,$value)
	{
		$flush = (is_null($_SESSION['flush'])? [] : unserialize($_SESSION['flush']));
		array_push($flush, $name);
		$_SESSION['flush'] = serialize($flush);

		$_SESSION[$name] = $value;
		return true;
	}
}