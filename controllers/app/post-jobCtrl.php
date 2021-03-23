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


$data['id_user'] = user_infos('id');

$action = 'insert';
if(isset($_GET['edit']) && !empty($_GET['edit']) && is_numeric($_GET['edit'])){
	$data = $Model->extraireChamp('*','emplois','id='.$_GET['edit']);
	$action = 'update';
}

$Form->set($data);

if(isset($_POST['submit_job'])){	
	unset($_POST['submit_job']);		
	
	$_POST['domaine'] = !empty($_POST['domaine']) ? '#'.(implode('#', $_POST['domaine'])).'#' : null;
	$_POST['id_user'] = user_infos('id');
	$_POST['date_enreg'] = date('Y-m-d');

	//var_dump($_POST);
	
	if($Model->{$action}($_POST,'emplois')){

		$alert['msg'] = 'Votre emploi a bien été ajouté';
		$alert['class'] = 'success';		

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/'.$users_types[$_SESSION['auth']['type']].'/post-job');
		exit;
	}else{

		if(isset($_GET['api']) && !empty($_POST)){
			echo json_encode(array('error'=>array('message'=>'impossible de poster votre emploi')));
			exit;
		}

		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
	}
	
}
