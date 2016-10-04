<?php
namespace Controller;
use Vender\View;

Class HomeController extends View
{
	public static function index()
	{
		return View::make('page.home');
	}
}