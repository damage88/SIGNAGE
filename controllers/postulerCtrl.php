<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/log-reg');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}else{
	if(user_infos('type') == 1){
		header('Location:'.$_SERVER['HTTP_REFERER']);
		$Session->setFlash('Votre profil est de type Recruteur', 'info');
		exit;
	}
}

$id_candidat = user_infos('id');

if(isset($_GET['id']) && is_numeric($_GET['id'])){	

	$fav = $Model->extraireChamp('*', 'postuler', 'valid=1 AND statut=1 AND id_candidat='.$id_candidat.' AND id_emploi='.$_GET['id']);	
	
	$_POST['id'] = '';
	$_POST['id_candidat'] = $id_candidat;
	$_POST['id_emploi'] = $_GET['id'];	
	$_POST['date_enreg'] = date('Y-m-d');	


	if(empty($fav)){
		if($Model->insert($_POST,'postuler')){
			$alert['msg'] = 'Vous avez postulé avec succès';
			$alert['class'] = 'success';		
		}else{
			$alert['msg'] = 'Impossible de postuler à cette offre';
			$alert['class'] = 'error';
		}
	}else{
		$alert['msg'] = 'Vous avez déjà postulé à cette offre';
		$alert['class'] = 'info';

		if(isset($_GET['cancel'])){
			$sql = "DELETE FROM postuler WHERE id_candidat = {$id_candidat} AND id_emploi = {$_GET['id']}";
			$requete = $DB->prepare($sql); 
			if($requete->execute()){
				$alert['msg'] = 'Postulation supprimée avec succès';
				$alert['class'] = 'success';
			}else{
				$alert['msg'] = 'Impossible de supprimer cette postulation';
				$alert['class'] = 'error';
			}
		}
	}

	

	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
	
}




