<?php 

if(!isset($_SESSION['auth']['id'])){
	header('Location:/connexion');
	$Session->setFlash('Veuillez vous connecter pour continuer.', 'info');
	exit;
}

$user_id = null;
// gestion des types de compte
if(user_infos('id') && user_infos('type') == 0){
	$user_id = user_infos('id');
}

if(user_infos('id') && user_infos('type') != 0 && isset($_GET['id_client']) && is_numeric($_GET['id_client'])){
	$user_id = $_GET['id_client'];
}


if(isset($_GET['edit']) && !empty($_GET['edit'])){
	$edit = $Model->extraireChamp("*",'adresses','id='.$_GET['edit'].' AND id_client='.$user_id);
	$Form->set($edit);
}

$adresses = $Model->extraireTableau("*",'adresses','id_client='.$user_id);

//$Form->set($user);

if(isset($_POST['submit_adresse'])){	
	unset($_POST['submit_adresse']);	

	$_POST['id_client'] = $user_id;

	$_POST['date_enreg'] = gmdate('Y-m-d H:i:s');

	//exit;
	//echo $dossier_img.'users_pics/'.$_POST['image'];

	if(isset($_POST['password1']) && isset($_POST['password2'])
		&& !empty($_POST['password1']) && !empty($_POST['password2']) 
		&& $_POST['password1'] == $_POST['password2']
	){
		$_POST['password'] = sha1($_POST['password1']);		
	}

	unset($_POST['password1'], $_POST['password2']);

	//var_dump($_POST);
	//exit;

	if($Model->insert($_POST,'adresses')){

		//var_dump($_POST);

		$alert['msg'] = 'Votre adresse a bien été ajoutée';
		$alert['class'] = 'success';

		
	   	//var_dump($user_infos);

	   	if(user_infos('id') && user_infos('type') != 0 && isset($_GET['id_client']) && is_numeric($_GET['id_client'])){
	   		$Session->setFlash('L\'adresse a bien été ajoutée',$alert['class']);
			header('Location:/checkout?id_client='.$_GET['id_client']);
			exit;
	   	}

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}else{

		
		$alert['msg'] = 'impossible d\'ajouter votre adresse';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
	}
	
}

if(isset($_POST['edit_adresse'])){	
	unset($_POST['edit_adresse']);	

	$_POST['id_client'] = $user_id;

	//exit;
	//echo $dossier_img.'users_pics/'.$_POST['image'];

	if(isset($_POST['password1']) && isset($_POST['password2'])
		&& !empty($_POST['password1']) && !empty($_POST['password2']) 
		&& $_POST['password1'] == $_POST['password2']
	){
		$_POST['password'] = sha1($_POST['password1']);		
	}

	unset($_POST['password1'], $_POST['password2']);

	//var_dump($_POST);
	//exit;

	if($Model->update($_POST,'adresses')){

		//var_dump($_POST);

		$alert['msg'] = 'Votre adresse a bien été modifiée';
		$alert['class'] = 'success';
		
	   	//var_dump($user_infos);

	   	if(user_infos('id') && user_infos('type') != 0 && isset($_GET['id_client']) && is_numeric($_GET['id_client'])){
	   		$Session->setFlash('L\'adresse a bien été modifiée',$alert['class']);
			header('Location:/checkout?id_client='.$_GET['id_client']);
			exit;
	   	}

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:'.$_SERVER['HTTP_REFERER']);
		exit;
	}else{

		$alert['msg'] = 'impossible de modifier votre adresse';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
	}
	
}





