<?php 
	
	$__no_header = $__no_footer = true;

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

	// selection de la scene
	$current_scene = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND (id_playlist='.$_GET['current_playlist'].' AND id = '.$_GET['current_scene'].') ORDER BY ordre ASC LIMIT 1');

	$scene = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND (id_playlist='.$_GET['current_playlist'].' AND id != '.$_GET['current_scene'].') AND ordre > '.$current_scene['ordre'].' ORDER BY ordre ASC LIMIT 1');

	if(empty($scene)){
		$scene = $Model->extraireChamp('*', 'scenes', 'valid=1 AND statut=1 AND id_playlist='.$_GET['current_playlist'].' ORDER BY ordre ASC LIMIT 1');
	}

	echo json_encode($scene);

	exit;
