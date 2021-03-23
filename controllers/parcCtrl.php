<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

if(isset($_POST['create_ecran']) && !empty($_POST['libelle_fr'])){	
	unset($_POST['create_ecran']);
	
	$action = 'insert';
	if(empty($_POST['id']) || $_POST['id'] == 0){
		$_POST['id'] = '';
		$_POST['date_enreg'] = date('Y-m-d H:i:s');	
		$_POST['code'] = initReference(4);	

		$action = 'insert';
	}else{
		$action = 'update';
	}
	
	$_POST['id_user'] = user_infos('id');

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


/////////////////////

if(isset($_POST['create_groupe']) && !empty($_POST['ecrans']) && !empty($_POST['libelle_fr'])){	
	unset($_POST['create_groupe']);

	$action = 'insert';
	if(empty($_POST['id']) || $_POST['id'] == 0){
		$_POST['id'] = '';
		$_POST['date_enreg'] = date('Y-m-d H:i:s');	
		//$_POST['code'] = initReference(4);	

		$action = 'insert';
	}else{
		$action = 'update';
	}

	$post_ecrans = $_POST['ecrans'];
	unset($_POST['ecrans']);
	$post_ecrans_liste = implode(',', $post_ecrans);

	if($id_groupe = $Model->{$action}($_POST,'groupes_ecrans')){

		if($action == 'update'){
			$id_groupe = $_POST['id'];
		}

		//maj des values id_groupe
		$sql = "UPDATE ecrans SET id_groupe = {$id_groupe} WHERE id IN ({$post_ecrans_liste})";
		$requete = $DB->prepare($sql); 
		$requete->execute();

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

if(isset($_POST['create_reseau']) && !empty($_POST['groupes']) && !empty($_POST['libelle_fr'])){	
	unset($_POST['create_reseau']);
	
	$_POST['id'] = '';
	$_POST['id_user'] = user_infos('id');
	$_POST['date_enreg'] = date('Y-m-d H:i:s');	

	$post_groupes = $_POST['groupes'];
	unset($_POST['groupes']);
	$post_groupes_liste = implode(',', $post_groupes);

	if($id_reseau = $Model->insert($_POST,'reseaux')){

		//maj des values id_groupe
		$sql = "UPDATE groupes_ecrans SET id_reseau = {$id_reseau} WHERE id IN ({$post_groupes_liste})";
		$requete = $DB->prepare($sql); 
		$requete->execute();

		$alert['msg'] = 'Réseau d\'écran ajouté avec succès';
		$alert['class'] = 'success';		
	}else{
		$alert['msg'] = 'Impossible d\'ajouter le réseau d\'écran';
		$alert['class'] = 'error';
	}

	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;	
}


if(isset($_GET['type']) && !empty($_GET['type'])){

	switch ($_GET['type']) {
		case 'groupes':
			$groupes_ecrans = $Model->extraireTableau('*', 'groupes_ecrans', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');

			if(!empty($groupes_ecrans)){
				foreach ($groupes_ecrans as $k => $v) {
					$groupes_ecrans[$k]['ecrans'] = $Model->extraireTableau('*', 'ecrans', 'id_groupe='.$v['id'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
				}
			}

			$view = 'groupes_ecrans.tpl';
			break;

		case 'reseaux':
			$reseaux_groupes = $Model->extraireTableau('*', 'reseaux', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');

			if(!empty($reseaux_groupes)){
				foreach ($reseaux_groupes as $k => $v) {
					$reseaux_groupes[$k]['groupes'] = $Model->extraireTableau('*', 'groupes_ecrans', 'id_reseau='.$v['id'].' AND id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
				}
			}
			$view = 'reseaux_groupes.tpl';
			break;
		
		default:
			$ecrans = $Model->extraireTableau('*', 'ecrans', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
			$view = 'ecrans.tpl';
			break;
	}

}else{
	$ecrans = $Model->extraireTableau('*', 'ecrans', 'id_user='.user_infos('id').' AND valid=1 ORDER BY id DESC');
	$view = 'ecrans.tpl';
}

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




