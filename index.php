<?php session_start(); ?>
<?php
	$tz = date_default_timezone_set("Asia/Bangkok");
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