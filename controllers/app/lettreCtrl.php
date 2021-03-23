<?php 


//$lettre = $Model->extraireChamp('*', 'lettres', 'valid=1 AND statut=1 AND id_candidat='.$id_candidat,'ordre ASC, id DESC');
$action = 'insert';
if(isset($_POST['submit_lettre'])){	
	unset($_POST['submit_lettre']);	

	if(!empty($_POST['id'])){
		$action = 'update';
	}else{
		$action = 'insert';
	}

	$_POST['date_enreg'] = date('Y-m-d');


	if($Model->{$action}($_POST,'lettres')){

		$alert['msg'] = 'Votre lettre de motivation a bien étée mise à jour';
		$alert['class'] = 'success';		

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/'.$users_types[$_SESSION['auth']['type']].'/resume');
		exit;
	}else{

		if(isset($_GET['api']) && !empty($_POST)){
			echo json_encode(array('error'=>array('message'=>'impossible de mettre votre lettre de motivation à jour')));
			exit;
		}

		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/'.$users_types[$_SESSION['auth']['type']].'/resume');
		exit;
	}
	
}




