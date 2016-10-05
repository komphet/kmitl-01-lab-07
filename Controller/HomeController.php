<?php
namespace Controller;
use Vender\View;
use Vender\DB;
use Vender\Helper;
use Model\Person;

Class HomeController extends View
{
	public static function index()
	{
		$db = new DB;
		if(!$db->connect()) Helper::redirect('setup');
		$members = Person::get();
		if($members === false) Helper::redirect('setup');


		return View::make('page.home',compact('members'));
	}
}