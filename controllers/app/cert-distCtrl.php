<?php 


$data['id_candidat'] = user_infos('id');
$action = 'insert';
if(isset($_GET['edit']) && !empty($_GET['edit']) && is_numeric($_GET['edit'])){
	$data = $Model->extraireChamp('*','certificats','valid=1 AND statut=1 AND id='.$_GET['edit']);
	$action = 'update';
	$data['date_fin'] = formatDate($data['date_fin'],'%Y-%m');
}
$Form->set($data);

if(isset($_POST['submit_cert'])){	
	unset($_POST['submit_cert']);		
	
	
	$_POST['date_enreg'] = date('Y-m-d');
	$_POST['date_fin'] 	 = $_POST['date_fin'].'-01';

	//var_dump($_POST);
	//exit;
	

	if($Model->{$action}($_POST,'certificats')){

		$alert['msg'] = 'Votre contenu a bien été mis à jour';
		$alert['class'] = 'success';		

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/'.$users_types[$_SESSION['auth']['type']].'/resume');
		exit;
	}else{

		if(isset($_GET['api']) && !empty($_POST)){
			echo json_encode(array('error'=>array('message'=>'impossible de mettre votre contenu à jour')));
			exit;
		}

		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
	}
	
}




