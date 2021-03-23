<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/log-reg');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}else{
	if(user_infos('type') == 0){
		header('Location:'.$_SERVER['HTTP_REFERER']);
		$Session->setFlash('Votre profil est de type Candidat', 'info');
		exit;
	}
}

// recruteur
 $id_recruteur = user_infos('id');
if(isset($_GET['code']) && !empty($_GET['code'])){
	$candidat = $Model->extraireChamp('id','users','code="'.strtoupper($_GET['code']).'"');
	if($candidat){

		$id_candidat = $candidat['id'];
		$_GET['id'] = $id_candidat;

	}else{
		
		$alert['msg'] = 'Candidat inexistant';
		$alert['class'] = 'error';

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}
}

if(isset($_GET['id']) && is_numeric($_GET['id'])){	

	$fav = $Model->extraireChamp('*', 'favoris_cv', 'valid=1 AND statut=1 AND id_candidat='.$id_candidat.' AND id_recruteur='.$id_recruteur);	
	
	$_POST['id'] = '';
	$_POST['id_candidat'] = $id_candidat;
	$_POST['id_recruteur'] = $id_recruteur;	
	$_POST['date_enreg'] = date('Y-m-d');	


	if(empty($fav)){
		if($Model->insert($_POST,'favoris_cv')){
			$alert['msg'] = 'Ajouté aux favoris';
			$alert['class'] = 'success';		
		}else{
			$alert['msg'] = 'Impossible d\'ajouter aux favoris';
			$alert['class'] = 'error';
		}
	}else{
		$sql = "DELETE FROM favoris_cv WHERE id_candidat = {$id_candidat} AND id_recruteur = {$id_recruteur}";
		$requete = $DB->prepare($sql); 
		if($requete->execute()){
			$alert['msg'] = 'Supprimé des favoris';
			$alert['class'] = 'success';
		}else{
			$alert['msg'] = 'Impossible de supprimer des favoris';
			$alert['class'] = 'error';
		}
	}

	$Session->setFlash($alert['msg'],$alert['class']);
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
	
}




