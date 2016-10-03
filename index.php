<?php
	require_once("Controller/autoload.php");
	switch ($_GET['action']) {
		case 'register':
			new Controller\RegisterController;
			break;
	}


?>