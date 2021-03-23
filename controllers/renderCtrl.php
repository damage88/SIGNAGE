<?php 

if(isset($_GET['ajax'])){
	$__no_header = $__no_footer = true;
}

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
				$oldlog['timestamp'] = gmdate('Y-m-d H:i:s');
				$oldlog['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
				$Model->update($oldlog, 'logs_ecrans');
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

	$planning = $Model->extraireChamp('plannings_plages.*', 'plannings_plages LEFT JOIN plannings ON plannings_plages.id_planning = plannings.id', 'plannings_plages.id_cible='.$ecran['id'].' AND plannings_plages.type="ecrans" AND plannings.valid=1 AND plannings.statut = 1 AND plannings_plages.date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND plannings_plages.date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY plannings_plages.id ASC');

	// switch du planning
	// cas de groupe
	if(empty($planning) && isset($current_groupe) && !empty($current_groupe)){
		//$planning = $Model->extraireTableau('*', 'plannings_plages', 'id_cible='.$current_groupe['id'].' AND type="groupes" AND date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY id ASC');

		$planning = $Model->extraireChamp('plannings_plages.*', 'plannings_plages LEFT JOIN plannings ON plannings_plages.id_planning = plannings.id', 'plannings_plages.id_cible='.$current_groupe['id'].' AND plannings_plages.type="groupes" AND plannings.valid=1 AND plannings.statut = 1 AND plannings_plages.date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND plannings_plages.date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY plannings_plages.id ASC');
	}

	// cas de reseau
	if(empty($planning) && isset($current_reseau) && !empty($current_reseau)){
		//$planning = $Model->extraireTableau('*', 'plannings_plages', 'id_cible='.$current_reseau['id'].' AND type="reseaux" AND date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY id ASC');

		$planning = $Model->extraireChamp('plannings_plages.*', 'plannings_plages LEFT JOIN plannings ON plannings_plages.id_planning = plannings.id', 'plannings_plages.id_cible='.$current_reseau['id'].' AND plannings_plages.type="reseaux" AND plannings.valid=1 AND plannings.statut = 1 AND plannings_plages.date_debut <= "'.gmdate('Y-m-d H:i:s').'" AND plannings_plages.date_fin > "'.gmdate('Y-m-d H:i:s').'" ORDER BY plannings_plages.id ASC');
	}

	$planning_final = $planning;

	if(!empty($planning_final)){
		$article = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id='.$planning_final['id_scene']);
		$now   = strtotime(gmdate('Y-m-d H:i:s'));
		$date_fin = strtotime($planning_final['date_fin']);
		$duree  = abs($date_fin - $now);
		$planning_final['date_update'] = $article['date_update'];
		$article['duree'] = $duree;
		$scene_initiale = $article;
		$scene_initiale['mode_flux'] = 'planning';
	}else{

		// en continu
		// les plannings de l'écran
		if(is_null($ecran['default_playlist']) || $ecran['default_playlist'] == 0){
			$current_groupe = $Model->extraireChamp('*', 'groupes_ecrans', 'valid=1 AND statut=1 AND id='.$ecran['id_groupe']);
		}else{
			$default_playlist = $ecran['default_playlist'];
		}

		if(isset($current_groupe) && !empty($current_groupe) && !is_null($current_groupe['default_playlist']) && $current_groupe['default_playlist'] != 0){
			$default_playlist = $current_groupe['default_playlist'];
		}else{
			if(isset($current_reseau) && !empty($current_reseau)){
				$current_reseau = $Model->extraireChamp('*', 'reseaux', 'valid=1 AND statut=1 AND id='.$current_groupe['id_reseau']);
			}
		}

		if(isset($current_reseau) && !empty($current_reseau) && !is_null($current_reseau['default_playlist']) && $current_reseau['default_playlist'] != 0){
			$default_playlist = $current_reseau['default_playlist'];
		}

		$is_active_playlist = $Model->extraireChamp('id', 'playlists', 'valid=1 AND statut=1 AND id='.$default_playlist);
		

		if(!is_null($default_playlist) && $is_active_playlist){
			$scene_initiale = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$default_playlist.' ORDER BY ordre ASC LIMIT 1');
		}

		if(isset($_GET['current_scene']) && is_numeric($_GET['current_scene']) && $is_active_playlist){
			$current_scene = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$default_playlist.' AND id='.$_GET['current_scene'].' ORDER BY ordre ASC LIMIT 1');

			if(!empty($current_scene)){
				$scene_initiale = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$default_playlist.' AND ordre > '.$current_scene['ordre'].' ORDER BY ordre ASC LIMIT 1');

				if(empty($scene_initiale)){
					$scene_initiale = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$default_playlist.' ORDER BY ordre ASC LIMIT 1');
				}
			}else{
				$scene_initiale = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$default_playlist.' ORDER BY ordre ASC LIMIT 1');
			}
			
		}


		if(isset($scene_initiale) && !empty($scene_initiale)){
			$scene_initiale['mode_flux'] = 'continu';
		}
	}


	if(isset($_GET['ajax'])){
		if(!empty($scene_initiale)){
			echo json_encode($scene_initiale);
		}else{
			echo json_encode(array('html'=> '<div id="machine" style="background-color:#fff">Aucun contenu en diffusion disponible</div>', 'duree'=>10));
		}		
		exit;
	}


}else{
	header('Location:/init');
	exit;
}

