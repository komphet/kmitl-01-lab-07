<?php
namespace Controller;
use Vender\View;

Class RegisterController extends View
{
	public function __construct()
	{
		if($_SERVER['REQUEST_METHOD'] === 'GET'){
			return $this->index();
		}
	}

	protected function index()
	{
		return View::make('page.register');
	}
}