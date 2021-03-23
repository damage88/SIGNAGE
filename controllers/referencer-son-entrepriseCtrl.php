<?php
if(!empty($_SESSION['form'])){
	$Form->set($_SESSION['form']); 
}

if(isset($_POST['referencer'])){	
	unset($_POST['referencer']);	

	uploadFichier2('fichier',array('doc','docx','pdf'),$dossier_fichiers, $name = strtoupper(slug($_POST['libelle_fr'])).'-formulaire-referencement-'.rand(00000,99999));

	uploadFichier2('image',array('jpg','jpeg','png'),$dossier_img);

	$_SESSION['form'] = $_POST;
	var_dump($_SESSION['form']);
	
	if($Model->insert($_POST,'entreprises')){

		$_SESSION['form'] = null;

		$alert['msg'] = 'Votre demande a bien été soumise.';
		$alert['class'] = 'success';

			   	
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/referencer-son-entreprise');
		exit;
	}else{

		$alert['msg'] = 'Une erreur est survenue';
		$alert['class'] = 'error';
		$Session->setFlash($alert['msg'],$alert['class']);
		header('Location:/referencer-son-entreprise');
		exit;
	}
	
}

