<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

if(isset($_POST['create_client']) && !empty($_POST['nom']) && !empty($_POST['email'])){	
	unset($_POST['create_client']);
	
	$action = 'insert';
	if(empty($_POST['id']) || $_POST['id'] == 0){
		$_POST['id'] = '';
		$_POST['date_enreg'] = date('Y-m-d H:i:s');	
		$_POST['code'] = initReference(6);
		$_POST['id_gestionnaire'] = user_infos('id');
		$_POST['type'] = 2;
		if(user_infos('type') == 0){
			$_POST['type'] = 1;
		}
		$action = 'insert';
	}else{
		$action = 'update';
	}
	
	//exit;
	if($Model->{$action}($_POST,'ecrans')){
		$alert['msg'] = 'Enregistrement effectué avec succès';
		$alert['class'] = 'success';		
	}else{
		$alert['msg'] = 'Impossible d\'effectur l\'enregistrement';
		$alert['class'] = 'error';
	}

	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;	
}

// les ecrans du user
$ecrans_tabs = $Model->extraireTableau('id,code, libelle_fr','ecrans','valid = 1 AND statut = 1 AND ( id_groupe = 0 OR id_groupe IS NULL ) AND id_user ='.user_infos('id'));
$liste_ecrans = array();
if(!empty($ecrans_tabs)){
	foreach ($ecrans_tabs  as $k => $v) {
		$liste_ecrans[$v['id']] = 'Ecran ('.$v['code'].') ' .$v['libelle_fr'];
	}
}
/////////////////////

// les groupes du user
$groupes_tabs = $Model->extraireTableau('id,code, libelle_fr','groupes_ecrans','valid = 1 AND statut = 1 AND id_user ='.user_infos('id'));
$liste_groupes_ecrans = array();
if(!empty($groupes_tabs)){
	foreach ($groupes_tabs  as $k => $v) {
		$liste_groupes_ecrans[$v['id']] = $v['libelle_fr'];
	}
}

$groupes_tabs = $Model->extraireTableau('id,code, libelle_fr','groupes_ecrans','valid = 1 AND statut = 1 AND ( id_reseau = 0 OR id_reseau IS NULL ) AND id_user ='.user_infos('id'));
$liste_groupes_ecrans2 = array();
if(!empty($groupes_tabs)){
	foreach ($groupes_tabs  as $k => $v) {
		$liste_groupes_ecrans2[$v['id']] = $v['libelle_fr'];
	}
}

// les reseaux du users
$reseaux_tabs = $Model->extraireTableau('id,code, libelle_fr','reseaux','valid = 1 AND statut = 1 AND id_user ='.user_infos('id'));
$liste_reseaux = array();
if(!empty($reseaux_tabs)){
	foreach ($reseaux_tabs  as $k => $v) {
		$liste_reseaux[$v['id']] = $v['libelle_fr'];
	}
}

// les playlists du users
$playlists_tabs = $Model->extraireTableau('id, libelle_fr','playlists','valid = 1 AND statut = 1 AND id_user ='.user_infos('id'));
$liste_playlists = array();
if(!empty($playlists_tabs)){
	foreach ($playlists_tabs  as $k => $v) {
		$liste_playlists[$v['id']] = $v['libelle_fr'];
	}
}

$ecrans = $Model->extraireTableau('*', 'ecrans', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');

if(isset($ecrans) && !empty($ecrans)){
	foreach ($ecrans as $k => $v) {
		$ecrans[$k]['is_active'] = false;
		$is_active = $Model->extraireChamp('id','logs_ecrans','code_ecran="'.$v['code'].'" AND DATE_ADD(timestamp, INTERVAL +15 SECOND) >= "'.gmdate('Y-m-d H:i:s').'"');
		if($is_active){
			$ecrans[$k]['is_active'] = true;
		}
	}

	$sorted = array_orderby($ecrans, 'is_active', SORT_DESC);
	$ecrans = $sorted;
}




