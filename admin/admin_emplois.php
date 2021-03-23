<?php 
require_once 'config.php';

/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = formEmplois();
		echo $html;
		break;

	case 'form':
		$html = formEmplois();
		echo $html;
		break;

	default:
		$html = formEmplois();
		echo $html;
		break;
}
//ob_end_flush(); 

