<?php 
$id_patient = $_SESSION['auth']['id'];
if(isset($_GET['api'])){
	if(isset($_GET['id_patient']) ){
		$id_patient = $_GET['id_patient'];
	}
}

$user = $Model->extraireChamp("*",'users','id='.$id_patient);
$Form->set($user);

if(isset($_GET['api']) && empty($_POST)){
	if(isset($_GET['id_patient'])){
		echo json_encode($user);
		//var_dump($user);
	}else{
		echo 'ID patient non fourni';
		return false;
	}
}


//var_dump($user);

if(isset($_POST['submit_profil'])){	
	unset($_POST['submit_profil']);	

	uploadFichier2('image',array('jpeg','png','gif','jpg'),$dossier_img.'users_pics/');
	
	if(empty($_POST['image'])){
		unset($_POST['image']);
	} 


	if(empty($_POST['date_naiss'])){
		unset($_POST['date_naiss']);
	} 

	//var_dump($_POST);
	//exit;
	//echo $dossier_img.'users_pics/'.$_POST['image'];

	if(isset($_POST['password_new']) && !empty($_POST['password_new'])){
		$_POST['password'] = sha1($_POST['password_new']);		
	}

	if($_POST['categorie'] != 189){
		$_POST['categorie2'] = null;		
	}

	unset($_POST['password1'], $_POST['password2'], $_POST['password_new']);

	//var_dump($_POST);
	//exit;

	if($Model->update($_POST,'users')){

		//var_dump($_POST);

		$alert['msg'] = 'Votre profil a bien été mis à jour';
		$alert['class'] = 'success';

		$user_infos = $Model->extraireChamp('*','users','id ='.$_POST['id']);
	   	if(!isset($_GET['api'])){
	   		$_SESSION['auth']['user_infos'] = 	$user_infos;
	   		$_SESSION['auth'] = $user_infos;
	   	}	   	

	   	//var_dump($user_infos);

	   	if(isset($_GET['api'])){
			echo json_encode($user_infos);
			exit;
		}

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profil');
		exit;
	}else{

		if(isset($_GET['api']) && !empty($_POST)){
			echo json_encode(array('error'=>array('message'=>'impossible de mettre votre profil à jour')));
			exit;
		}

		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
	}
	
}


if(isset($_POST['submit_password'])){	


	unset($_POST['submit_password']);
	// Verification du mot de passe en cas de changement
	if(isset($_POST['password1']) && isset($_POST['password2'])	&& !empty($_POST['password1']) && !empty($_POST['password2']) && ($_POST['password1'] == $_POST['password2'])
	){
		$_POST['password'] = sha1($_POST['password1']);		
	}else{

		if(isset($_GET['api'])){
			echo json_encode(array('error'=>array('message'=>'Veuillez saisir des mot de passe identiques')));
			exit;
		}

		$alert['msg'] = 'Veuillez saisir des mot de passe identiques';
		$alert['class'] = 'error';

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profil');
		exit;
	}

	unset($_POST['password1'], $_POST['password2']);

	if($Model->update($_POST,'users')){

		$alert['msg'] = 'Votre Mot de passe a bien été mis à jour';
		$alert['class'] = 'success';

		$user_infos = $Model->extraireChamp('*','users','id ='.$DB->quote($_POST['id']));
	   	$_SESSION['auth']['user_infos'] = 	$user_infos;

	   	if(isset($_GET['api'])){
			echo json_encode(array('success'=>array('message'=>'Votre Mot de passe a bien été mis à jour')));
			exit;
		}

		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profil');
		exit;
	}else{

		if(isset($_GET['api'])){
			echo json_encode(array('error'=>array('message'=>'impossible de modifier votre mot de passe')));
			exit;
		}

		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
	}
}


if($user['type'] == 1){
	$view = 'profil_recruteur.tpl';
}