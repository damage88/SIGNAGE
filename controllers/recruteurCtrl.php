<?php


if(!isset($_SESSION['auth']['id'])){
	header('Location:/log-reg');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}else{
	if(user_infos('type') == 0){
		header('Location:'.$_SERVER['HTTP_REFERER']);
		$Session->setFlash('Votre profil est de type Candidat', 'info');
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


$total_fav_cv = $Model->extraireChamp('COUNT(id) as total','favoris_cv','id_recruteur='.user_infos('id'));
$total_emplois = $Model->extraireChamp('COUNT(id) as total','emplois','id_user='.user_infos('id'));
$total_emplois_ouverts = $Model->extraireChamp('COUNT(id) as total','emplois','id_user='.user_infos('id').' AND date_limite > '.date('Y-m-d'));

$sql = "SELECT COUNT(postuler.id) as total FROM postuler LEFT JOIN emplois ON emplois.id = postuler.id_emploi LEFT JOIN users ON users.id = emplois.id_user WHERE 1 ";
$requete = $DB->prepare($sql); 
$requete->execute();
$total_postulations = $requete->fetch(PDO::FETCH_ASSOC);


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