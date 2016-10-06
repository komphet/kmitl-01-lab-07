<?php
namespace Controller;
use Vender\View;
use Vender\DB;
use Vender\Helper;
use Model\Person;

Class RegisterController extends View
{
	public function __construct()
	{
		switch ($_GET['method']) {
			case 'store':
				return $this->store($_POST);
				break;
			case 'destroy':
				return $this->destroy($_GET);
				break;
			case 'update':
				return $this->update($_POST);
				break;
			default :
				return $this->index();
				break;

		}
	}

	public function index()
	{
		return View::make('page.register');
	}

	public function store($request)
	{
		$db = new DB;
		if(!$db->connect()) return Helper::redirect('setup');
		$insert = $db->insert('person',[
			[
				'ID'            => $request['id'],
				'Name'          => $request['fname'].' '.$request['lname'],
				'Date of Birth' => $request['dateofbirth'],
				'Weight'        => $request['weight'],
				'Gender'        => $request['gender'],
			],
		]);
		if(!$insert) Helper::redirect('setup');
		return Helper::redirect('/');
	}

	public function destroy($request)
	{
		Person::delete($request['id']);
		return Helper::redirect('/');
	}

	public function update($request)
	{
		Person::update($_GET['id'],[
			'ID'=>$request['id'],
			'Date of Birth'=>$request['dateofbirth'],
			'Name'=>$request['fname'].' '.$request['lname'],
			'Weight'=>$request['weight'],
			'Gender'=>$request['gender'],
		]);
		
		return Helper::redirect('/');
	}
}