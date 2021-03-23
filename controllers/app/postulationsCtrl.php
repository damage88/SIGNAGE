<?php

if(!isset($_SESSION['auth']['id'])){
	header('Location:/log-reg');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

$applyed_job = $Model->extraireTableau('*','postuler','id_candidat='.user_infos('id'));
if(!empty($applyed_job)){
	foreach ($applyed_job as $k => $v) {
		$temp = $Model->extraireChamp('*', 'emplois','id='.$v['id_emploi']);
		
		if(!empty($temp)){
			$temp['user'] = $Model->extraireChamp('id, nom, image','users', 'id='.$temp['id_user']);
			
			$emploi_domaine = explode('#', $temp['domaine']);
			array_pop($emploi_domaine);
			array_shift($emploi_domaine);

			$temp['domaine'] = $emploi_domaine;
			$applyed_job[$k] = $temp;
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

