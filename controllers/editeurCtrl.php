<?php 


if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

if(isset($_POST['submit_playlist']) ){	

	//var_dump($_POST);
	//exit;
	
	$to_update_scenes = array();
	if(is_array($_POST['id_scene']) && !empty($_POST['id_scene'])){
		foreach ($_POST['id_scene'] as $k => $v) {
			$to_update_scenes[$k]['id'] = $v;
			$to_update_scenes[$k]['duree'] = $_POST['duree'][$k];
			$to_update_scenes[$k]['ordre'] = $k;
		}
	}

	if(!empty($to_update_scenes)){
		foreach ($to_update_scenes as $k => $v) {
			$test = 1;
			if($Model->update($v,'scenes')){
				$test = $test * 1;
			}else{
				$test = $test * 0;
			}
		}
	}

	unset($_POST['id_scene'], $_POST['duree'], $_POST['ordre'], $_POST['submit_playlist'], $_POST['id_playlist']);
	$Model->update($_POST,'playlists');

	if($test == 1){
		$alert['msg'] = 'Playlist éditée avec succès';
		$alert['class'] = 'success';	
	}else{
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
	}

	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
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


$playlist = array();
if(isset($_GET['playlist']) && is_numeric($_GET['playlist'])){
	$playlist = $Model->extraireChamp('*', 'playlists', 'id_user='.user_infos('id').' AND valid=1 AND id='.$_GET['playlist']);
	
	if(!empty($playlist))
		$scenes = $Model->extraireTableau('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$playlist['id'].' ORDER BY ordre ASC');
}


if(isset($_GET['id_scene']) && !empty($_GET['id_scene'])){	
	$article = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id='.$_GET['id_scene'].' ORDER BY id ASC');	
}


if(empty($playlist)){
	header('Location:/playlists');
	$Session->setFlash('Veuillez vous selectionner ou ajouter une playlist avant de continuer.', 'info');
	exit;
}




