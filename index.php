<?php
	require_once("Controller/autoload.php");
	switch ($_GET['action']) {
		case 'register':
			new Controller\RegisterController;
			break;
		case 'setup':
			new Controller\SetupController;
			break;
		default :
			Controller\HomeController::index();
			break;
	}


?>