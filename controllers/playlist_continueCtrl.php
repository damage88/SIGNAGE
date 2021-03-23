<?php 
	
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
		
	}
	
	// les plannings de l'écran
	if(is_null($ecran['default_playlist']) || $ecran['default_playlist'] == 0){
		$current_groupe = $Model->extraireChamp('*', 'groupes_ecrans', 'valid=1 AND statut=1 AND id='.$ecran['id_groupe']);
	}else{
		$default_playlist = $ecran['default_playlist'];
	}

	if(isset($current_groupe) && !empty($current_groupe) && !is_null($current_groupe['default_playlist']) && $current_groupe['default_playlist'] != 0){
		$default_playlist = $current_groupe['default_playlist'];
	}else{
		$current_reseau = $Model->extraireChamp('*', 'reseaux', 'valid=1 AND statut=1 AND id='.$current_groupe['id_reseau']);
	}

	if(isset($current_reseau) && !empty($current_reseau) && !is_null($current_reseau['default_playlist']) && $current_reseau['default_playlist'] != 0){
		$default_playlist = $current_reseau['default_playlist'];
	}
	

	if(!is_null($default_playlist)){
		$scene = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$default_playlist.' ORDER BY ordre ASC LIMIT 1');
	}

	if(isset($_GET['scene']) && is_numeric($_GET['scene'])){
		$scene = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$default_playlist.' AND id='.$_GET['scene'].' ORDER BY ordre ASC LIMIT 1');
	}


