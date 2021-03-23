<?php

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

$ogimage = "ogfb_root.jpg";

$total_ecrans = $Model->extraireChamp('COUNT(id) as total', 'ecrans', 'valid=1 AND id_user='.user_infos('id'));
$total_groupes = $Model->extraireChamp('COUNT(id) as total', 'groupes_ecrans', 'valid=1 AND id_user='.user_infos('id'));
$total_reseaux = $Model->extraireChamp('COUNT(id) as total', 'reseaux', 'valid=1 AND id_user='.user_infos('id'));
$total_playlists = $Model->extraireChamp('COUNT(id) as total', 'playlists', 'valid=1 AND id_user='.user_infos('id'));

// les playlists du user
$plannings = $Model->extraireTableau('plannings.*, playlists.libelle_fr as playlist','plannings LEFT JOIN playlists ON playlists.id = plannings.id_playlist','plannings.valid = 1 AND plannings.id_user ='.user_infos('id').' ORDER BY plannings.id DESC LIMIT 3');

if(!empty($plannings)){
	foreach($plannings as $k => $v){
		$date_debut = $Model->extraireChamp('MIN(date_debut) as date_debut', 'plannings_plages', 'valid=1 AND statut=1 AND id_planning='.$v['id'].' ORDER BY id ASC LIMIT 1');
		$date_fin = $Model->extraireChamp('MAX(date_fin) as date_fin', 'plannings_plages', 'valid=1 AND statut=1 AND id_planning='.$v['id'].' ORDER BY id DESC LIMIT 1');

		$plannings[$k]['date_debut'] = $date_debut['date_debut'];
		$plannings[$k]['date_fin'] = $date_fin['date_fin'];

		$etat = $classe = '';

		if($v['statut'] == 1){
			if($plannings[$k]['date_debut'] < gmdate('Y-m-d H:i:s')){
				if($plannings[$k]['date_fin'] > gmdate('Y-m-d H:i:s')){
					$etat = 'En Cours';
					$classe = 'etiquette_verte';
				}else{
					$etat = 'Terminé';
					$classe = 'etiquette_violette';
				}
			}else{
				$etat = 'En Attente';
				$classe = 'etiquette_orange';
			}
		}else{
			$etat = 'Non Diffusé';
			$classe = 'etiquette_rouge';
		}

		$plannings[$k]['etat'] = $etat;		
		$plannings[$k]['classe'] = $classe;		
	}
}

$active_screens = $Model->extraireChamp('COUNT(id) as total','logs_ecrans','DATE_ADD(timestamp, INTERVAL +15 SECOND) >= "'.gmdate('Y-m-d H:i:s').'"');

if(!isset($active_screens['total'])){
	$active_screens['total'] = 0;
}

if(!isset($total_ecrans['total'])){
	$total_ecrans['total'] = 0;
}

$ecrans_actifs = $active_screens['total'];
$pourcentage_actif = ($ecrans_actifs * 100) / $total_ecrans['total'];
$ecrans_inactifs = $total_ecrans['total'] - $active_screens['total'];
$pourcentage_inactif = ($ecrans_inactifs * 100) / $total_ecrans['total'];

//$view = 'home.tpl';
