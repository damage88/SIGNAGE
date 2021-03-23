<?php

if(!isset($_SESSION['auth']['id'])){
	header('Location:/log-reg');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

$fav_cv = $Model->extraireTableau('*','favoris_cv','id_recruteur='.user_infos('id'));

if(!empty($fav_cv)){
	foreach ($fav_cv as $k => $v) {
		$temp = $Model->extraireChamp('*','users','id='.$v['id_candidat']);
		/*$compte = $Model->extraireChamp('COUNT(id) as total','postuler','id_emploi='.$v['id']);
		if($compte){
			$jobs[$k]['postuler'] = $compte['total'];
		}else{
			$jobs[$k]['postuler'] = 0;
		}*/

		$user_domaine = explode('#', $temp['domaine']);
		if(!empty($user_domaine)){
			array_pop($user_domaine);
			array_shift($user_domaine);
		}

		$fav_cv[$k] = $temp;
		$fav_cv[$k]['domaine'] = $user_domaine;

	}
}


// chargement des données

/*$user_domaine = explode('#', $_SESSION['auth']['domaine']);
array_pop($user_domaine);
array_shift($user_domaine);

$user_langues = explode('#', $_SESSION['auth']['langues']);
array_pop($user_langues);
array_shift($user_langues);*/

