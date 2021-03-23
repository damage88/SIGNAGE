<?php 
require_once 'config.php';

/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = formEvents();
		echo $html;
		break;

	case 'form':
		$html = formEvents();
		echo $html;
		break;

	default:
		$html = formEvents();
		echo $html;
		break;
}
//ob_end_flush(); 

