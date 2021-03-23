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
	
}
exit;