<?php 

if(isset($_POST['submit_formations'])){	
	unset($_POST['submit_formations']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}

	if($last_id = $Model->{$action}($_POST,'formations')){
		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}

if(isset($_POST['submit_parcours'])){	
	unset($_POST['submit_parcours']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}

	if($last_id = $Model->{$action}($_POST,'parcours')){
		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}

if(isset($_POST['submit_competences'])){	
	unset($_POST['submit_competences']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}	

	if($last_id = $Model->{$action}($_POST,'competences')){

		if($action == 'insert'){
			$requete = $DB->prepare("DELETE FROM competences WHERE id_user = {$_POST['id_user']} AND id_competence = {$_POST['id_competence']} AND id != $last_id");
			$requete->execute();
		}

		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}

if(isset($_POST['submit_langues'])){	
	unset($_POST['submit_langues']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}	

	if($last_id = $Model->{$action}($_POST,'langues')){

		if($action == 'insert'){
			$requete = $DB->prepare("DELETE FROM langues WHERE id_user = {$_POST['id_user']} AND id_langue = {$_POST['id_langue']} AND id != $last_id");
			$requete->execute();
		}

		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}



if(isset($_POST['submit_competences_personnelles'])){	
	unset($_POST['submit_competences_personnelles']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}	

	if($last_id = $Model->{$action}($_POST,'competences_personnelles')){

		if($action == 'insert'){
			$requete = $DB->prepare("DELETE FROM competences_personnelles WHERE id_user = {$_POST['id_user']} AND id_competence = {$_POST['id_competence']} AND id != {$last_id}");
			$requete->execute();
		}

		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}


if(isset($_POST['submit_permis'])){	
	unset($_POST['submit_permis']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}	

	if($last_id = $Model->{$action}($_POST,'permis_de_conduire')){

		//if($action == 'insert'){
			$requete = $DB->prepare("DELETE FROM permis_de_conduire WHERE id_user = {$_POST['id_user']} AND id != {$last_id}");
			$requete->execute();
		//}

		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}


if(isset($_POST['submit_cameras'])){	
	unset($_POST['submit_cameras']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}	

	if($last_id = $Model->{$action}($_POST,'cameras')){

		//if($action == 'insert'){
			$requete = $DB->prepare("DELETE FROM cameras WHERE id_user = {$_POST['id_user']} AND id != {$last_id}");
			$requete->execute();
		//}

		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}



if(isset($_POST['submit_supports_cameras'])){	
	unset($_POST['submit_supports_cameras']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}	

	if($last_id = $Model->{$action}($_POST,'supports_cameras')){

		//if($action == 'insert'){
			$requete = $DB->prepare("DELETE FROM supports_cameras WHERE id_user = {$_POST['id_user']} AND id != {$last_id}");
			$requete->execute();
		//}

		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}



if(isset($_POST['submit_photos'])){	
	unset($_POST['submit_photos']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}

	uploadFichier2('image',array('jpeg','png','gif','jpg'),$dossier_img);
	
	if(empty($_POST['image'])){
		unset($_POST['image']);
	} 

	//var_dump($_POST);
	//exit;

	if($Model->{$action}($_POST,'photos')){
		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}

if(isset($_POST['submit_videos'])){	
	unset($_POST['submit_videos']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}

	if($Model->{$action}($_POST,'videos')){
		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}



if(isset($_POST['submit_biographie'])){	
	unset($_POST['submit_biographie']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}	

	if($last_id = $Model->{$action}($_POST,'biographies')){

		if($action == 'insert'){
			$requete = $DB->prepare("DELETE FROM biographies WHERE id_user = {$_POST['id_user']} AND id != {$last_id}");
			$requete->execute();
		}

		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}



if(isset($_POST['submit_filmographie'])){	
	unset($_POST['submit_filmographie']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d');
		$action = 'insert';
	}	

	if($last_id = $Model->{$action}($_POST,'filmographies')){

		if($action == 'insert'){
			$requete = $DB->prepare("DELETE FROM filmographies WHERE id_user = {$_POST['id_user']} AND id != {$last_id}");
			$requete->execute();
		}

		$alert['msg'] = 'Information enregistrée avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/profils?id='.user_infos('id'));
		exit;
	}
	
}



header('Location:/profils?id='.user_infos('id'));
exit;

/*if(isset($_POST['submit_password'])){
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
}*/


