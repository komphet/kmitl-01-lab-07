<?php
namespace Vender;
use Config\App;

Class Helper
{
	public static function url($url)
	{
		$baseURI = new App;
		$config = ($baseURI->config('BASE_URL')!='')?$baseURI->config('BASE_URL')
		:'http://'.preg_replace('/\/index.*/', '', $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']);
		$baseURI = preg_replace('/(\/)$/', '', $config);
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