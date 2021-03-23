<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}



if(isset($_POST['libelle_fr']) && !empty(trim($_POST['libelle_fr']))){	

	
	$_POST['id'] = '';
	$_POST['id_user'] = user_infos('id');
	$_POST['date_enreg'] = date('Y-m-d H:i:s');	


	if($id_playlist = $Model->insert($_POST,'playlists')){
		$alert['msg'] = 'Liste de diffusion créée avec succès';
		$alert['class'] = 'success';

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/editeur?playlist='.$id_playlist);
		exit;	

	}else{
		$alert['msg'] = 'Impossible de créer la liste de diffusion';
		$alert['class'] = 'error';
	}
	
	

	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
	
}

$playlists = $Model->extraireTableau('*', 'playlists', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');

if(!empty($playlists)){
	foreach ($playlists as $k => $v) {
		$playlists[$k]['scenes'] = $Model->extraireTableau('*', 'scenes', 'id_playlist='.$v['id']);
	}
}





