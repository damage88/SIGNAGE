<?php 

$id_candidat = user_infos('id');
$is_recruteur = false;
if(user_infos('type') > 0){
	$is_recruteur = true;
}

// recruteur
if(isset($_GET['code']) && !empty($_GET['code'])){
	$candidat = $Model->extraireChamp('*','users','code="'.strtoupper($_GET['code']).'"');
	if($candidat){
		$id_candidat = $candidat['id'];
	}else{
		
		$alert['msg'] = 'Candidat inexistant';
		$alert['class'] = 'error';

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}
}
$parcours = $Model->extraireTableau('*', 'parcours', 'valid=1 AND statut=1 AND id_candidat='.$id_candidat,'ordre ASC, id DESC');
$exp_pro = $Model->extraireTableau('*', 'exp_pro', 'valid=1 AND statut=1 AND id_candidat='.$id_candidat,'ordre ASC, id DESC');
$certificats = $Model->extraireTableau('*', 'certificats', 'valid=1 AND statut=1 AND id_candidat='.$id_candidat,'ordre ASC, id DESC');
$lettre = $Model->extraireChamp('*', 'lettres', 'valid=1 AND statut=1 AND id_candidat='.$id_candidat);


$Form->set($lettre);

if(isset($_POST['submit_parcours'])){	
	unset($_POST['submit_parcours']);
	
	$_POST['date_enreg'] = date('Y-m-d');
	$_POST['date_debut'] = $_POST['date_debut'].'-01';
	$_POST['date_fin'] 	 = $_POST['date_fin'].'-01';

	//var_dump($_POST);
	//exit;

	if($Model->insert($_POST,'parcours')){

		$alert['msg'] = 'Votre parcours a bien été mis à jour';
		$alert['class'] = 'success';		

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/'.$users_types[$_SESSION['auth']['type']].'/resume');
		exit;
	}else{

		if(isset($_GET['api']) && !empty($_POST)){
			echo json_encode(array('error'=>array('message'=>'impossible de mettre votre parcours à jour')));
			exit;
		}

		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
	}
	
}




