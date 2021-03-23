<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

// les ecrans du user
$ecrans_tabs = $Model->extraireTableau('id,code, libelle_fr','ecrans','valid = 1 AND statut = 1 AND id_user ='.user_infos('id'));
$liste_ecrans = array();
if(!empty($ecrans_tabs)){
	foreach ($ecrans_tabs  as $k => $v) {
		$liste_ecrans[$v['id']] = 'Ecran ('.$v['code'].') ' .$v['libelle_fr'];
	}
}
/////////////////////


if(isset($_GET['type']) && !empty($_GET['type']) && isset($_GET['cible']) && is_numeric($_GET['cible'])){
	$cible = array();
	switch ($_GET['type']) {
		case 'groupes':
			$cible = $Model->extraireChamp('*', 'groupes_ecrans', 'id='.$_GET['cible'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');			
			break;

		case 'reseaux':
			$cible = $Model->extraireChamp('*', 'reseaux', 'id='.$_GET['cible'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
			break;
		
		case 'ecrans':
			$cible = $Model->extraireChamp('*', 'ecrans', 'id='.$_GET['cible'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
			break;
	}

}

if(isset($_POST['create_ecran']) && !empty($_POST['libelle_fr'])){	
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

// les playlists du user
$playlists_tab = $Model->extraireTableau('id, libelle_fr','playlists','valid = 1 AND statut = 1 AND id_user ='.user_infos('id'));
$playlists = array();
if(!empty($playlists_tab)){
	foreach ($playlists_tab  as $k => $v) {
		$playlists[$v['id']] = $v['libelle_fr'];
	}
}

if(isset($_GET['playlist']) && is_numeric($_GET['playlist'])){
	$liste_scenes = $Model->extraireTableau('*','scenes','valid = 1 AND statut = 1 AND id_playlist ='.$_GET['playlist'].' AND id_user ='.user_infos('id').' ORDER BY ordre ASC');

}


/////////////////////






