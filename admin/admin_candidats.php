<?php 
require_once 'config.php';

/*
*	CHOIX DE L'ACTION A EFFECTUER
*/

//ob_start();
switch (isset($_GET['action'])?$_GET['action']:'') {
	case 'liste':
		$html = formCandidats();
		echo $html;
		break;

	case 'form':
		$html = formCandidats();
		echo $html;
		break;

	default:
		$html = formCandidats();
		echo $html;
		break;
}
//ob_end_flush(); 

