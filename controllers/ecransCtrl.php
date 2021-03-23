<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}



if(isset($_POST['create_ecran'])){	
	unset($_POST['create_ecran']);
	
	$_POST['id'] = '';
	$_POST['id_user'] = user_infos('id');
	$_POST['date_enreg'] = date('Y-m-d H:i:s');	
	$_POST['code'] = initReference(4);	


	if($Model->insert($_POST,'ecrans')){
		$alert['msg'] = 'écran ajouté avec succès';
		$alert['class'] = 'success';		
	}else{
		$alert['msg'] = 'Impossible d\'ajouter un écran';
		$alert['class'] = 'error';
	}
	
	

	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
	
}

$ecrans = $Model->extraireTableau('*', 'ecrans', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');





