<?php 

require '../admin/config.php';

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}


// les events
$scenes = array();
if(isset($_GET['planning'])){
	$scenes_tab = $Model->extraireTableau('*','plannings_plages','valid = 1 AND statut = 1 AND id_user ='.user_infos('id').' AND id_planning='.$_GET['planning']);

	
	if(!empty($scenes_tab)){
		foreach ($scenes_tab as $k => $v) {

			$row['title'] = 'Scène '.$v['id_scene'];
			$row['start'] = $v['date_debut'];
			$row['end'] = $v['date_fin'];

			$scenes[] = $row;
		}
	}
}
echo json_encode($scenes);
//var_dump($scenes_tab);




