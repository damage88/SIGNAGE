<?php

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

$fav = $Model->extraireTableau('*','favoris','id_recruteur='.user_infos('id'));
if(!empty($fav)){
	foreach ($fav as $k => $v) {
		$temp = $Model->extraireChamp('*', 'users','id='.$v['id_candidat']);		
		if(!empty($temp)){			
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

