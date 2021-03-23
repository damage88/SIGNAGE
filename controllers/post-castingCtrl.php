<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}else{
	if(user_infos('type') == 0){
		header('Location:'.$_SERVER['HTTP_REFERER']);
		$Session->setFlash('Votre profil ne peut pas poster de casting', 'info');
		exit;
	}
}
