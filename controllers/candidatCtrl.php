<?php

if(!isset($_SESSION['auth']['id'])){
	header('Location:/log-reg');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}else{
	if(user_infos('type') == 1){
		header('Location:'.$_SERVER['HTTP_REFERER']);
		$Session->setFlash('Votre profil est de type Recruteur', 'info');
		exit;
	}
}

$_SESSION['auth'] = $Model->extraireChamp('*','users','id='.$_SESSION['auth']['id']);

$id_candidat = user_infos('id');

// chargement des données

$user_domaine = explode('#', $_SESSION['auth']['domaine']);
array_pop($user_domaine);
array_shift($user_domaine);

$user_langues = explode('#', $_SESSION['auth']['langues']);
array_pop($user_langues);
array_shift($user_langues);




$_SESSION['auth']['domaine'] = $user_domaine;
$_SESSION['auth']['langues'] = $user_langues;


$total_fav = $Model->extraireChamp('COUNT(id) as total','favoris_jobs','id_candidat='.user_infos('id'));
$total_postulations = $Model->extraireChamp('COUNT(id) as total','postuler','id_candidat='.user_infos('id'));


if(isset($_GET['params'][0])){
		
	// Gestion des sous templates
	if(file_exists(WEBROOT.$_GET['params'][0].".tpl")){
		$sub_view = $_GET['params'][0].".tpl";
	}else{
		$sub_view = "no_content.tpl";
	}

	// Gestion des sous controller
	if(file_exists('controllers/app/'.$_GET['params'][0]."Ctrl.php")){
		require_once 'controllers/app/'.$_GET['params'][0]."Ctrl.php";
	}		
}