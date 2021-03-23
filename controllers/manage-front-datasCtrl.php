<?php 

if(isset($_POST['submit_casting'])){	
	unset($_POST['submit_casting']);

	$action = 'update';
	if(empty($_POST['id'])){
		$_POST['date_enreg'] = gmdate('Y-m-d H:i:s');
		$action = 'insert';
	}

	$_POST['auteur'] = user_infos('id');
	$_POST['slug_fr'] = slug($_POST['libelle_fr']);

	if($last_id = $Model->{$action}($_POST,'articles')){
		$alert['msg'] = 'Casting enregistré avec succès';
		$alert['class'] = 'success';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/annonces-castings?author='.user_infos('id'));
		exit;
	}else{		
		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/post-casting');
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

