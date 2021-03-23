<?php

if(!isset($_SESSION['auth']['id'])){
	header('Location:/log-reg');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

$fav = $Model->extraireTableau('*','favoris_jobs','id_candidat='.user_infos('id'));
if(!empty($fav)){
	foreach ($fav as $k => $v) {
		$temp = $Model->extraireChamp('*', 'emplois','id='.$v['id_emploi']);
		
		if(!empty($temp)){
			$temp['user'] = $Model->extraireChamp('id, nom, image','users', 'id='.$temp['id_user']);
			
			$emploi_domaine = explode('#', $temp['domaine']);
			array_pop($emploi_domaine);
			array_shift($emploi_domaine);

			$temp['domaine'] = $emploi_domaine;
			$fav[$k] = $temp;
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

