<?php

if(!isset($_SESSION['auth']['id'])){
	header('Location:/log-reg');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

$jobs = $Model->extraireTableau('*','emplois','id_user='.user_infos('id'));

if(!empty($jobs)){
	foreach ($jobs as $k => $v) {
		$compte = $Model->extraireChamp('COUNT(id) as total','postuler','id_emploi='.$v['id']);
		if($compte){
			$jobs[$k]['postuler'] = $compte['total'];
		}else{
			$jobs[$k]['postuler'] = 0;
		}

	}
}

// chargement des données

/*$user_domaine = explode('#', $_SESSION['auth']['domaine']);
array_pop($user_domaine);
array_shift($user_domaine);

$user_langues = explode('#', $_SESSION['auth']['langues']);
array_pop($user_langues);
array_shift($user_langues);*/

