<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}


// les playlists du user
$plannings = $Model->extraireTableau('plannings.*, playlists.libelle_fr as playlist','plannings LEFT JOIN playlists ON playlists.id = plannings.id_playlist','plannings.valid = 1 AND plannings.id_user ='.user_infos('id').' ORDER BY plannings.id DESC');

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


if(isset($_GET['change_statut']) && !empty(trim($_GET['change_statut']))){
	$cplanning = $Model->extraireChamp('*', 'plannings', 'valid=1 AND id='.$_GET['change_statut'].' AND id_user='.user_infos('id'));

	if(!empty($cplanning)){
		
		$cplanning['statut'] = ($cplanning['statut'] == 1 ? 0 : 1);
		//var_dump($planning);
		//exit;
		if($Model->update($cplanning,'plannings')){
			$alert['msg'] = 'Statut changé avec succès';
			$alert['class'] = 'success';
			$Session->setFlash($alert['msg'],$alert['class']);
			header('Location:'.$_SERVER['HTTP_REFERER']);
			exit;
		}
	}
	$alert['msg'] = 'Impossible de changer le statut';
	$alert['class'] = 'error';
	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}

