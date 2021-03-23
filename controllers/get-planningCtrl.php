<?php 

$__no_header = $__no_footer = true;

//var_dump($_GET);

if(isset($_GET['code']) && !empty($_GET['code'])){	
	$ecran = $Model->extraireChamp('*', 'ecrans', 'valid=1 AND statut=1 AND code="'.$_GET['code'].'"');

	if(empty($ecran)){
		$Session->setFlash('Ecran introuvable','info');
		header('Location:/init');
		exit;
	}

	// on ajoute au logs
	$oldlog = $Model->extraireChamp('*', 'logs_ecrans', 'code_ecran="'.$_GET['code'].'" AND DATE_FORMAT(date_enreg, "%Y-%m-%d") = "'.gmdate('Y-m-d').'"');
	if(!empty($oldlog))	{

		$difference_in_seconds = strtotime(gmdate('Y-m-d H:i:s')) - strtotime($oldlog['timestamp']);
		if($oldlog['code_ecran'] == $_GET['code'] && $oldlog['user_agent'] == $_SERVER['HTTP_USER_AGENT'] ){
			$oldlog['timestamp'] = gmdate('Y-m-d H:i:s');
			$Model->update($oldlog, 'logs_ecrans');
		}else{

			if( $difference_in_seconds > 30){
				$log = array('id'=>null, 'code_ecran'=>$_GET['code'], 'user_agent'=>$_SERVER['HTTP_USER_AGENT'], 'date_enreg'=>gmdate('Y-m-d H:i:s'));
				$Model->insert($log, 'logs_ecrans');
			}else{
				echo 'Cet écran est déjà en utilisation <br>';
				echo $oldlog['user_agent'];
				exit;
			}
		}
	}else{
		$log = array('id'=>null, 'code_ecran'=>$_GET['code'], 'user_agent'=>$_SERVER['HTTP_USER_AGENT'], 'date_enreg'=>gmdate('Y-m-d H:i:s'));
		$Model->insert($log, 'logs_ecrans');
	}

	// les plannings de l'écran
	if(!is_null($ecran['id_groupe']) && $ecran['id_groupe'] != 0){
		$current_groupe = $Model->extraireChamp('*', 'groupes_ecrans', 'valid=1 AND statut=1 AND id='.$ecran['id_groupe']);
		//var_dump($current_groupe);
	}

	if(isset($current_groupe) && !empty($current_groupe) && !is_null($current_groupe['id_reseau']) && $current_groupe['id_reseau'] != 0){
		$current_reseau = $Model->extraireChamp('*', 'reseaux', 'valid=1 AND statut=1 AND id='.$current_groupe['id_reseau']);
		//var_dump($current_reseau);
	}

	$planning = $Model->extraireTableau('plannings_plages.*', 'plannings_plages LEFT JOIN plannings ON plannings_plages.id_planning = plannings.id', 'plannings_plages.id_cible='.$ecran['id'].' AND plannings_plages.type="ecrans" AND plannings.valid=1 AND plannings.statut = 1 AND plannings_plages.date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND plannings_plages.date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY plannings_plages.id ASC');

	// switch du planning
	// cas de groupe
	if(empty($planning) && isset($current_groupe) && !empty($current_groupe)){
		//$planning = $Model->extraireTableau('*', 'plannings_plages', 'id_cible='.$current_groupe['id'].' AND type="groupes" AND date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY id ASC');

		$planning = $Model->extraireTableau('plannings_plages.*', 'plannings_plages LEFT JOIN plannings ON plannings_plages.id_planning = plannings.id', 'plannings_plages.id_cible='.$current_groupe['id'].' AND plannings_plages.type="groupes" AND plannings.valid=1 AND plannings.statut = 1 AND plannings_plages.date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND plannings_plages.date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY plannings_plages.id ASC');
	}

	// cas de reseau
	if(empty($planning) && isset($current_reseau) && !empty($current_reseau)){
		//$planning = $Model->extraireTableau('*', 'plannings_plages', 'id_cible='.$current_reseau['id'].' AND type="reseaux" AND date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY id ASC');

		$planning = $Model->extraireTableau('plannings_plages.*', 'plannings_plages LEFT JOIN plannings ON plannings_plages.id_planning = plannings.id', 'plannings_plages.id_cible='.$current_reseau['id'].' AND plannings_plages.type="reseaux" AND plannings.valid=1 AND plannings.statut = 1 AND plannings_plages.date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND plannings_plages.date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY plannings_plages.id ASC');
	}


	$planning_final = $planning;

	if(!empty($planning_final)){
		$article = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id='.$planning_final[0]['id_scene']);
		//$article = $planning_final[0];
		$planning_final[0]['date_update'] = $article['date_update'];
	}

	if(isset($planning_final) && !empty($planning_final)){
		echo json_encode(array('current_plage'=>$planning_final[0]));
	}else{
		echo 0;
	}
}
exit;