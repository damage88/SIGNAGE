<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

$id_client = user_infos('id');

if(isset($_GET['id']) && is_numeric($_GET['id']) && user_infos('type') == 0){	

	$fav = $Model->extraireChamp('*', 'favoris', 'valid=1 AND statut=1 AND id_client='.$id_client.' AND id_produit='.$_GET['id']);	
	
	$_POST['id'] = '';
	$_POST['id_client'] = $id_client;
	$_POST['id_produit'] = $_GET['id'];	
	$_POST['date_enreg'] = date('Y-m-d');	


	if(empty($fav)){
		if($Model->insert($_POST,'favoris')){
			$alert['msg'] = 'Ajouté aux favoris';
			$alert['class'] = 'success';		
		}else{
			$alert['msg'] = 'Impossible d\'ajouter aux favoris';
			$alert['class'] = 'error';
		}
	}else{
		$sql = "DELETE FROM favoris WHERE id_client = {$id_client} AND id_produit = {$_GET['id']}";
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

header('Location:'.$_SERVER['HTTP_REFERER']);
exit;


