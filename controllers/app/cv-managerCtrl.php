<?php 


if(isset($_POST['submit_cv'])){	
	unset($_POST['submit_cv']);	

	uploadFichier2('fichier',array('doc','docx','pdf'),$dossier_fichiers, $name='CV-'.slug(user_infos('nom').'-'.user_infos('prenoms')));
	
	if(empty($_POST['fichier'])){
		unset($_POST['fichier']);
	} 
	

	if($Model->update($_POST,'users')){

		//var_dump($_POST);

		$alert['msg'] = 'Votre CV a bien été uploadé';
		$alert['class'] = 'success';

		$user_infos = $Model->extraireChamp('*','users','id ='.$_POST['id']);
	   	if(!isset($_GET['api'])){
	   		$_SESSION['auth']['user_infos'] = 	$user_infos;
	   		$_SESSION['auth'] = $user_infos;
	   	}	   	

	   	
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/'.$users_types[$_SESSION['auth']['type']].'/cv-manager');
		exit;
	}else{

		if(isset($_GET['api']) && !empty($_POST)){
			echo json_encode(array('error'=>array('message'=>'impossible d\'uploader votre CV')));
			exit;
		}

		$alert['msg'] = 'Une erreur est survenue ';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
	}
	
}